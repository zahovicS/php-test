<?php

namespace Src\Database;

use Src\App\Application;
use Src\Database\Database;

class DB{
    public static $database;
    private static $statement;
    private static $result;
    // protected static $table = "";
    // protected static $connection = "";
    // protected $database = null;

    // function __construct() {
    //     if(!$this->database) $this->database = Application::resolve(Database::class);
    // }

    // public static function table(string $table){
    //     self::$table = $table;
    //     return new self();
    // }
    // public static function connection(string $connection){
    //     self::$connection = $connection;
    //     return new self();
    // }
    // public static function all(){
    //     return [self::$table,self::$connection];
    // }

    public static function query($query, $params = [])
    {
        self::$database = Application::resolve(Database::class);
        self::$statement = self::$database->connection->prepare($query);
        self::$statement->execute($params);
        return new self;
    }

    public static function get()
    {
        self::$result = self::$statement->fetchAll();
        return self::$result;
    }

    public  static function first()
    {
        self::$result = self::$statement->fetch();
        return self::$result;
    }

    public  static function findOrFail()
    {
        $result = self::first();

        if (! $result) {
            die();
        }

        return $result;
    }
    public  static function toArray()
    {
        return (array) self::$result;
    }
}