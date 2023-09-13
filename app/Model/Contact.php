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
    public function __construct(?int $id = null, string $name = ' ', string $email = ' ', Address $address = new Address())
    {
        self::$pdo = DatabaseConnection::connect();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;

    }

    public function save(Contact $contact)
    {
        if ($contact->getId() == null) {
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
            print_r('teste');
            $phone->insertPhone();
        }
        return true;
    }


    public function update(): bool
    {
        $pdo = DatabaseConnection::connect();

        if ($this->getId() === null) {
            throw new \InvalidArgumentException("O ID do contato deve ser definido para realizar a atualização.");
        }

        // Atualize o contato
        $updateContact = $pdo->prepare('UPDATE contacts
        SET name = :name, email = :email, address_id = :address_id
        WHERE contact_id = :contact_id');

        $success = $updateContact->execute([
            ':contact_id' => $this->getId(),
            ':name' => $this->getName(),
            ':email' => $this->getEmail(),
            ':address_id' => $this->getAddress()->getAddressId()
        ]);

        if (!$success) {
            return false;
        }

        // Atualize o endereço
        $addressUpdated = $this->getAddress()->updateAddress();

        if (!$addressUpdated) {
            return false;
        }

        // Atualize os números de telefone, se necessário
        foreach ($this->getPhones() as $phone) {
            $phone->setContactId($this->getId());
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
        $result = $pdo->query('SELECT contacts.*, addresses.*, phones.* FROM contacts
                            LEFT JOIN addresses ON contacts.address_id = addresses.address_id
                            JOIN phones ON contacts.contact_id = phones.contact_id');

        $dataListContact = [];

        foreach ($result as $row) {
            $contactId = $row['contact_id'];

            if (!array_key_exists($contactId, $dataListContact)) {
                $dataListContact[$contactId] = new Contact(
                    $contactId,
                    $row["name"],
                    $row["email"]
                );
                $dataListContact[$contactId]->setAddress(new Address(
                    $row['address_id'],
                    $row ['street'],
                    $row['house_number'],
                    $row['complement'],
                    $row['zip_code'],
                    $row['city'],
                    $row['state']
                ));
            }

            if (!empty($row['phone_id'])) {
                $phone = new Phone($row['phone_id'], $row['area_code'], $row['number'], $contactId);
                $dataListContact[$contactId]->setPhones($phone);
            }
        }

        return $dataListContact;
    }

    /**
     * Busca um contato pelo ID.
     *
     * @param int $contactId O ID do contato a ser buscado.
     * @return Contact O contato encontrado ou null se não encontrado.
     */
    public static function findById(int $contactId): Contact
    {
        $pdo = DatabaseConnection::connect();

        $selectContact = $pdo->prepare('SELECT contacts.*, addresses.*
                                FROM contacts
                                LEFT JOIN addresses ON contacts.address_id = addresses.address_id
                                WHERE contacts.contact_id = :contact_id');


        $selectContact->execute([':contact_id'=> $contactId]);

        $row = $selectContact->fetch();

        if (!$row) {
            throw new \Exception("Contato não encontrado");
        }

        $contact = new Contact(
            $row['contact_id'],
            $row['name'],
            $row['email']
        );

        $contact->setAddress(new Address($row['address_id'], $row['street'], $row['house_number'], $row['complement'], $row['zip_code'], $row['city'], $row['state']));

        $selectPhones = $pdo->prepare('SELECT phone_id, area_code, number FROM phones WHERE contact_id = :contact_id');
        $selectPhones->execute([':contact_id'=> $contactId]);



        while ($phoneRow = $selectPhones->fetch()) {
            $phone = new Phone($phoneRow['phone_id'], $phoneRow['area_code'], $phoneRow['number'], $contactId);
            $contact->setPhones($phone);
        }

        return $contact;
    }

    public function deleteById(int $contactId): bool
    {
        $pdo = DatabaseConnection::connect();


        try {
            $pdo->beginTransaction();

            $phoneStatement = $pdo->prepare('DELETE FROM phones WHERE contact_id = :contact_id');
            $phoneStatement->bindValue(':contact_id', $contactId, \PDO::PARAM_INT);
            $phoneStatement->execute();

            $pdo->commit();

            return true;
        } catch (\PDOException $exception) {
            $pdo->rollBack();
            throw new \PDOException($exception->getMessage());
        }
    }

    public function deleteAll(): bool
    {
        $pdo = DatabaseConnection::connect();
        try {
            $pdo->beginTransaction();

            $smt = $pdo->prepare('DELETE FROM phones');
            $smt->execute();

            $smt = $pdo->prepare('DELETE FROM contacts');
            $smt->execute();

            $smt = $pdo->prepare('DELETE FROM addresses');
            $smt->execute();

            $pdo->commit();
            return true;
        } catch (\PDOException $exception) {
            $pdo->rollBack();
            throw new \PDOException($exception->getMessage());
        }
    }


    /**
     * @param $phones
     * @return void
     */
    public function setPhones($phones): void
    {
        if (is_array($phones)) {
            $this->phones = $phones;
        }
        elseif ($phones instanceof Phone) {
            $this->phones[] = $phones;
        } else {
            throw new \InvalidArgumentException("O argumento deve ser do tipo Phone ou um array de Phones.");
        }
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
    public function defineId(?int $id): void
    {
        if (!is_null($this->id)) {
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




