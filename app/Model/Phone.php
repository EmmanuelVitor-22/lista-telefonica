<?php

namespace App\Model;

use Src\config\DatabaseConnection;

class Phone extends DatabaseConnection
{
    private ?int $phone_id;
    private string $areaCode;
    private string $number;
    private ?int $contact_id;

    public function __construct(?int $phone_id , string $areaCode, string $number, ?int $contact_id)
    {
        $this->phone_id = $phone_id;
        $this->areaCode = $areaCode;
        $this->number = $number;
        $this->contact_id = $contact_id;
    }

    public function insertPhone(): bool
    {
        $pdo = DatabaseConnection::connect();

        if (strlen($this->getAreaCode()) > 4 || strlen($this->getNumber()) > 10) {
            throw new \InvalidArgumentException("Área ou número de telefone muito longo.");
        }

        $insertPhone = $pdo->prepare('INSERT INTO phones (area_code, number, contact_id) VALUES (:area_code, :number, :contact_id)');

        $success = $insertPhone->execute([
            ':area_code' => $this->getAreaCode(),
            ':number' => $this->getNumber(),
            ':contact_id' => $this->getContactId()
        ]);

        if (!$success) {
            return false;
        }

        // Defina o ID
        $this->defineId($pdo->lastInsertId());

        return true;
    }


    public function updatePhone(): bool
    {
        $pdo =  DatabaseConnection::connect();
            $update = $pdo->prepare('UPDATE phones 
                                      SET area_code = :area_code, number = :number 
                                      WHERE phone_id = :phone_id');
        try {
            $success = $update->execute([
                ':area_code' => $this->getAreaCode(),
                ':number' => $this->getNumber(),
                ':phone_id' => $this->getId()
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    /**
     * @return string
     */
    public function formattedPhone():string
    {
        return "($this->areaCode) $this->number";

    }


    public function getId(): ?int
    {
        return $this->phone_id;
    }

    public function defineId(int $phone_id):void
    {
        if (!is_null($this->phone_id)){
            throw  new  \DomainException("Você só pode definir um ID por vez");
        }
        $this->phone_id = $phone_id;

    }

    /**
     * @return string
     */
    public function getAreaCode(): string
    {
        return $this->areaCode;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    public function getContactId(): ?int
    {
        return $this->contact_id;
    }

    public function setContactId(?int $contact_id): void
    {
        $this->contact_id = $contact_id;
    }

    public function setAreaCode(string $areaCode): void
    {
        $this->areaCode = $areaCode;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }




}