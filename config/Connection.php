<?php

namespace Src\config;

class Connection
{
    private $host;
    private $dbname;
    private $user;
    private $password;


    public function __construct()
    {
    }


    public function setAttribute($conn)
    {

        $this->host = $conn['host'];
        $this->dbname = $conn['dbname'];
        $this->user = $conn['user'];
        $this->password = $conn['password'];
        return $conn;

    }

    public  function getConnection()
    {

    }

}