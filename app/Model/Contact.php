<?php

namespace App\Model;

use http\Exception;
use Src\config\DatabaseConnection;
require_once __DIR__ . '/../../vendor/autoload.php';
//require_once __DIR__ . '/../View/cadastro.php';


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
            return $this->insertContato();
        }
        return $this->update();
        
    }
    public function insertContato(): bool
    {
        $pdo = DatabaseConnection::connect();

        $insertContact = $pdo->prepare('INSERT INTO contacts (name, email, address_id)
                                        VALUES (:name, :email, :address_id)');



        $success = $insertContact->execute([
            ':name' => $this->getName(),
            ':email' => $this->getEmail(),
            ':address_id' => $this->getAddress()->getAddressId()
        ]);

        if (!$success) {
            return false;
        }

        $this->defineId($pdo->lastInsertId());
        $this->getAddress()->insertAddress();
        foreach ($this->getPhones() as $phone) {
            $phone->setContactId($this->getId());
            $phone->insertPhone();
        }
        return true;
    }

    //poderia ser feito no metodo de feito no metodo de insert contato, porém assim respeita o SOLID


    public function update(): bool
    {
        $pdo =  DatabaseConnection::connect();

        $update = $pdo->prepare('UPDATE contacts SET  name = :name, email = :email
                                                        WHERE contact_id = :contact_id;');

        $success = $update->execute([
            ':name'=>$this->getName(),
            ':email'=>$this->getEmail()
        ]);

        if (!$success){
            return false;
        }

        $this->getAddress()->updateAddress();
        foreach ($this->getPhones() as $phone) {
            $phone->updatePhone();
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
            $dataListContact[$row['contact_id']]->setAddress(new Address($row['address_id'],$row ['street'],
                                                                         $row['number'], $row['complement'],
                                                                         $row['zip_code'],$row['city'],$row['state']));

            $dataListContact[$row['contact_id']]->setPhones(new Phone($row['phone_id'], $row['area_code'],
                                                                      $row['number'],$row['contact_id']));
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
    public function setPhones(Phone $phone): void
    {
        $this->phones[] = $phone;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
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




