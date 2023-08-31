<?php

namespace App\Model;

class Address
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

    public function getAddressId(): ?int
    {
        return $this->address_id;
    }

    /**
     * Metodo para definir o id caso no momento da criação não tenha sido definido
     * é o mesmo que "setId
     * @param int|null $id
     */
    public function defineId(int $id):void
    {
        if (!is_null($this->id)){
            throw  new  \DomainException("Você só pode definir um ID por vez");
        }
        $this->id = $id;
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