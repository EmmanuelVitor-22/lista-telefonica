<?php

namespace App\Model;

class Phone
{
    private ?int $phone_id;
    private string $areaCode;
    private string $number;


    public function __construct(?int $phone_id , string $areaCode, string $number)
    {
        $this->phone_id = $phone_id;
        $this->areaCode = $areaCode;
        $this->number = $number;
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





}