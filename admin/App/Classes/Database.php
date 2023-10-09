<?php

namespace App\Classes;

use Exception;
use PDO;

class Database
{
    private $connection;

    public function __construct()
    {
        try {
            $serverName = 'localhost';
            $username = 'root';
            $pass = '';
            $databaseName = 'cafe';

            $this->connection = new PDO("mysql:host=$serverName;dbname=$databaseName", $username, $pass);

        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    public function runDataBase($run)
    {
        return $this->connection->query($run);
    }

}

// $db = new database();