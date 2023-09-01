<?php

namespace App\Model;

use http\Exception;
use Src\config\DatabaseConnection;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../View/cadastro.php';


class Contact extends DatabaseConnection
{
    private static $pdo;
    private ?int $id;
    private string $name;
    private string $email;
    private array $phones = [];

    private Address $address;

    /**
     * @param int|null $id
     * @param string $name
     * @param string $email
     * @param array $phones
     * @param Address $address
     */
    public function __construct(?int $id = null, string $name = ' ', string $email = ' ', Address $address =  new Address())
    {
        self::$pdo = DatabaseConnection::connect();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;

    }

    public function save(Contact $contact)
    {
        if ($contact->getId() == null){
            return $this->insert($contact);
        }
        return $this->update($contact);
        
    }
    public function insertContato()
    {
        $pdo = DatabaseConnection::connect();

        $insertContact = $pdo->prepare('INSERT INTO contacts (name, email, address_id)
                                        VALUES (:name, :email, :address_id)');

        // ... (outros campos de contato)

        $success = $insertContact->execute([
            ':name' => $this->getName(),
            ':email' => $this->getEmail(),
            ':address_id' => $this->getAddress()->getAddressId()
        ]);

        if ($success) {
            $this->defineId($pdo->lastInsertId());
            $this->getAddress()->insertAddress();
            foreach ($this->getPhones() as $phone) {
                $phone->setContactId($this->getId());
                $phone->insertPhone();
            }
            return true;
        } else {
            return false;
        }
    }

    //poderia ser feito no metodo de feito no metodo de insert contato, porém assim respeita o SOLID


    private function update(Contact $contact): bool
    {
        $pdo =  DatabaseConnection::connect();

        $update = $pdo->prepare('UPDATE contacts SET  name = :name, email = :email
                                                        WHERE contact_id = :contact_id;');

        $success = $update->execute([
            ':name'=>$contact->getName(),
            ':email'=>$contact->getEmail()
        ]);

        if (!$success){
            return false;
        }

        $contact->updatePhone($contact);
        $contact->updateAddress($contact);

        return true;
    }
    private function updatePhone(Contact $contact): bool
    {
        $pdo =  DatabaseConnection::connect();
        foreach ($contact->getPhones() as $phone) {
            $update = $pdo->prepare('UPDATE phones 
                                      SET area_code = :area_code, number = :number 
                                      WHERE phone_id = :phone_id');
           $success =  $update->execute([
                ':area_code' => $phone->getAreaCode(),
                ':number' => $phone->getNumber()
            ]);
            if (!$success){
                return false;
            }
        }
        return true;
    }
    private function updateAddress(Contact $contact): bool
    {
        $pdo =  DatabaseConnection::connect();
        $address = $contact->getAddress();

            $update = $pdo->prepare('UPDATE addresses 
                                            SET street = :street, number = :number, 
                                                complement = :complement, zip_code = :zip_code, 
                                                city = :city, state = :state 
                                            WHERE address_id = :address_id');

        $success = $update->execute([
                    ':street' => $address->getStreet(),
                    ':number' => $address->getNumber(),
                    ':complement' => $address->getComplement(),
                    ':zip_code' => $address->getZipCode(),
                    ':city' => $address->getCity(),
                    ':state' => $address->getState()
            ]);

        if (!$success){
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $pdo = DatabaseConnection::connect();
        $result = $pdo->query('SELECT contacts.*, addresses.*, phones.*
                                                     FROM contacts
                                                     LEFT JOIN addresses ON contacts.address_id = addresses.address_id
                                                     JOIN phones ON contacts.contact_id = phones.contact_id');

        $dataListContact = [];

        foreach ($result as $row) {
            if (!array_key_exists($row['contact_id'], $dataListContact)) {
                $dataListContact[$row['contact_id']] = new Contact(
                    $row['contact_id'],
                    $row["name"],
                    $row["email"]
                );
            }
            $dataListContact[$row['contact_id']]->setAddress($row['address_id'],$row ['street'],$row['number'],
                                                                 $row['complement'],$row['zip_code'],$row['city'],$row['state']);
            $dataListContact[$row['contact_id']]->setPhones($row['phone_id'], $row['area_code'], $row['number']);
        }

        return $dataListContact;
    }

    public function removeById($id): bool
    {
        $pdo = DatabaseConnection::connect();

        $smt = $pdo->prepare('DELETE FROM contacts WHERE contact_id = :contact_id');
        $smt->bindValue(':contact_id',$id,\PDO::PARAM_INT);

        return $smt->execute();
    }
    public function removeAll(): bool
    {
        $pdo = DatabaseConnection::connect();
        try {
            $smt = $pdo->prepare('DELETE FROM contacts');
            return $smt->execute();
        }catch (\PDOException $exception){
            throw new \PDOException($exception->getMessage());
        }

    }

    /**
     * @param ?int $id
     * @param string $area_code
     * @param string $number
     * correspomde ao metodo addPhone
     */
    public function setPhones(?int $id, $area_code, $number): void
    {
        $phones = new Phone($id, $area_code, $number);
        $this->phones[] = $phones;
    }

    /**
     * @param int|null $address_id
     * @param string $street
     * @param string $number
     * @param string $complement
     * @param string $zip_code
     * @param string $city
     * @param string $state
     */
    public function setAddress(?int $address_id ,string $street , string $number ,string $complement ,
                               string $zip_code ,string $city ,string $state ): void
    {
        $this->address = new Address($address_id , $street , $number,
            $complement , $zip_code , $city , $state );
    }


    /**
     * Metodo para definir o id caso no momento da criação não tenha sido definido
     * é o mesmo que "setId
     * @param int|null $id
     */
    public function defineId(?int $id):void
    {
        if (!is_null($this->id)){
            throw  new  \DomainException("Você só pode definir um ID por vez");
        }
        $this->id = $id;
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    /**
     * @return Phone[]
     */
    public function getPhones(): array
    {
        return $this->phones;
    }
    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }




}




