<?php

namespace Src\Database;

use PDO;
use PDOException;

class Database{

    private $connection;
    // public $statement;

    function __construct(array $config) {
        $dsn = "mysql:dbname=".$config["database"].";host=".$config["host"].";port=".$config["port"].";charset=".$config["charset"]."";
        try {
            $this->connection = new PDO($dsn, $config["username"], $config["password"], $config["options"]);
        } catch (PDOException $e) {
            throw new PDOException("Error Database: ".$e->getMessage());
        }
    }
    public function getConnection() {
        return $this->connection;
    }
}