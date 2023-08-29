<?php

namespace Src\config;

use PDOException;

/**
 *
 */
class DatabaseConnection
{
    private static $dbConnect;

    public function __construct()
    {
        $this->creatConnection();
    }


    /**
     * @return \PDO
     */
    private function creatConnection() : \PDO
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
            self::$dbConnect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$dbConnect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            return self::$dbConnect;
        } catch (PDOException $exception) {
            throw new \PDOException($exception->getMessage());
        }
    }

    /**
     * @return \PDO
     */
    public static function connect(): \PDO
    {
       // se não tiver instancia, cria
        if(!self::$dbConnect) {
            new DatabaseConnection();
        }
        // caso ja tenha ele só usa a conexão existente
        return self::$dbConnect;

    }

}


