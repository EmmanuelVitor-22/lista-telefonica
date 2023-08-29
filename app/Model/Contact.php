<?php

namespace App\Model;

use Src\config\DatabaseConnection;
require_once __DIR__ . '/../../vendor/autoload.php';

class Contact extends DatabaseConnection
{

    private static $pdo;
    private ?int $id;
    private string $name;
    private string $email;
    private array $phone = [];
    private Address $address;

    /**
     * @param int|null $id
     * @param string $name
     * @param string $email
     */
    public function __construct(?int $id = null, string $name = " ", string $email=" ")
    {
        self::$pdo = DatabaseConnection::connect();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $find = self::$pdo;
        $query = $find->query('select * from contatos;');
        $telefones = $query->fetchAll(\PDO::FETCH_ASSOC);

        $tels = [];
        foreach ($telefones as $t) {
            $tel = new Contact($t['contato_id'],
                $t['name'],
                $t['email'],

            );
            $tels[] = $tel;
        }

        return $tels;
    }

    /**
     * @param ?int $id
     * @param string $area_code
     * @param string $number
     * correspomde ao metodo addPhone
     */
    public function setPhones(?int $id, $area_code, $number): void
    {
        $phone = new Phone($id, $area_code, $number);
        $this->phones[] = $phone;
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
     * @return array
     */
    public function getPhone(): array
    {
        return $this->phone;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }





}




