<?php

namespace Src\Database;

use PDO;
use PDOException;

class Database{

    public $connection;
    // public $statement;

    function __construct(array $config) {
        $dsn = "mysql:dbname=".$config["database"].";host=".$config["host"].";port=".$config["port"].";charset=".$config["charset"]."";
        try {
            $this->connection = new PDO($dsn, $config["username"], $config["password"], $config["options"]);
        } catch (PDOException $e) {
            throw new PDOException("Error Database: ".$e->getMessage());
        }
    }
    // public function query($query, $params = [])
    // {
    //     $this->statement = $this->connection->prepare($query);

    //     $this->statement->execute($params);

    //     return $this;
    // }

    // public function get()
    // {
    //     return $this->statement->fetchAll();
    // }

    // public function first()
    // {
    //     return $this->statement->fetch();
    // }

    // public function findOrFail()
    // {
    //     $result = $this->first();

    //     if (! $result) {
    //         die();
    //     }

    //     return $result;
    // }
}