<?php

namespace Src\config;

use PDOException;

class Connection
{
    private static $dbConnect;

    public function __construct()
    {
        $this->creatConnection();
    }

    private function creatConnection()
    {
        $envPath = parse_ini_file(__DIR__ . '/../env.ini');

        $host = $envPath['host'];
        $dbname = $envPath['dbname'];
        $user = $envPath['user'];
        $password = $envPath['password'];

        $dataSourceName = "mysql:host=$host;dbname=$dbname";

        try {
            //DSN = Data Source Name, contem  informações do banco  que sãp requeridoas para fazer a conexão (host e dbname);
            self::$dbConnect = new \PDO($dataSourceName, $user, $password);
            print_r(self::$dbConnect);
            return self::$dbConnect;
        } catch (PDOException $exception) {
            throw new \PDOException($exception->getMessage());
        }
    }

    public static function connect()
    {
       // se não tiver instancia, cria
        if(!self::$dbConnect) {
            print_r("valor do teste do if-------> ", self::$dbConnect);
            new Connection();
        }
        // caso ja tenha ele só usa a conexão existente
        return self::$dbConnect;

    }



}


