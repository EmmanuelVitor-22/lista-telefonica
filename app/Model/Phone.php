<?php

namespace App\Model;

use Src\config\DatabaseConnection;

class Phone extends DatabaseConnection
{
    private ?int $phone_id;
    private string $areaCode;
    private string $number;
    private int $contact_id;

    public function __construct(?int $phone_id , string $areaCode, string $number, int $contact_id)
    {
        $this->phone_id = $phone_id;
        $this->areaCode = $areaCode;
        $this->number = $number;
        $this->contact_id = $contact_id;
    }

    public function insertPhone(): bool
    {
        $pdo = DatabaseConnection::connect();


            $insertPhone = $pdo->prepare('insert into phones (area_code, number, contact_id)
                                                                    values (:area_code,:number,:contact_id)');

            $success = $insertPhone->execute([
                        ':area_code' => $this->getAreaCode(),
                        ':number' => $this->getNumber(),
                        ':contact_id]' =>$contact->getId()
            ]);

            if (!$success){
                return false;
            }
            #definindo o id
            $this->defineId($pdo->lastInsertId());
            return true;
    }

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




}