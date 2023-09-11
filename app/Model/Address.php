<?php

namespace App\Model;

use Src\config\DatabaseConnection;

class Address extends DatabaseConnection
{
    private ?int $address_id ;
    private string $street ;
    private string $number ;
    private string $complement ;
    private string $zip_code ;
    private string $city ;
    private string $state ;

    /**
     * @param int|null $address_id
     * @param string $street
     * @param string $number
     * @param string $complement
     * @param string $zip_code
     * @param string $city
     * @param string $state
     */
    public function __construct(?int $address_id = null , string $street = '', string $number = '', string $complement = '---', string $zip_code = '', string $city = '', string $state = '')
    {
        $this->address_id = $address_id;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->zip_code = $zip_code;
        $this->city = $city;
        $this->state = $state;
    }


    public function insertAddress(): bool
    {
        $pdo = DatabaseConnection::connect();;
        if ($this->getAddressId() === null) {
            $insertAddress = $pdo->prepare('insert into addresses (street, number, complement, zip_code, city, state)
                                                values (:street, :number, :complement, :zip_code, :city, :state);');

            $success = $insertAddress->execute([':street' => $this->getStreet(),
                ':number' => $this->getNumber(),
                ':complement' => $this->getComplement(),
                ':zip_code' => $this->getZipCode(),
                ':city' => $this->getCity(),
                ':state' => $this->getState()
            ]);

            if (!$success) {
                return false;
            }

            $this->defineId($pdo->lastInsertId());
        }
        return true;
    }
    public function updateAddress(): bool
    {
        $pdo =  DatabaseConnection::connect();

        $update = $pdo->prepare('UPDATE addresses 
                                            SET street = :street, number = :number, 
                                                complement = :complement, zip_code = :zip_code, 
                                                city = :city, state = :state 
                                            WHERE address_id = :address_id');

        $success = $update->execute([
            ':street' => $this->getStreet(),
            ':number' => $this->getNumber(),
            ':complement' => $this->getComplement(),
            ':zip_code' => $this->getZipCode(),
            ':city' => $this->getCity(),
            ':state' => $this->getState()
        ]);

        if (!$success){
            return false;
        }
        return true;
    }

    public function getAddressId(): ?int
    {
        return $this->address_id;
    }

    /**
     * Metodo para definir o id caso no momento da criação não tenha sido definido
     * é o mesmo que "setId
     * @param int|null $id
     */
    public function defineId(?int $id):void
    {
        if (!is_null($this->address_id) && $this->address_id !== $id) {
            throw new \DomainException("Você só pode definir um ID por vez");
        }
        $this->address_id = $id;
    }

    /**
     * @return string
     */
    public function formatAddress(): string
    {
        $address = $this->getStreet() . ', ' . $this->getNumber();

        if (!empty($this->getComplement())) {
            $address .= ' - ' . $this->getComplement();
        }

        $address .= PHP_EOL . $this->getCity() . ' - ' . $this->getState() . ', ' . $this->getZipCode();

        return $address;
    }


    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

}