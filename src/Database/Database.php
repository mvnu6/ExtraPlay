<?php

namespace App\Database;

use PDO;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = 'db'; 
        $dbname = 'Extraplay';
        $user = 'postgres';
        $pass = 'password';

        $this->connection = new PDO(
            "pgsql:host=$host;dbname=$dbname",
            $user,
            $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
