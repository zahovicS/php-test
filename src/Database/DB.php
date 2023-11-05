<?php

namespace Src\Database;

use Src\Database\Database;
use stdClass;
use PDO;

class DB
{

    public static $instance = null;
    private static $statement = null;

    public static function connection(string $connection): DB
    {
        $config = config("database");
        self::$instance = (new Database($config[$connection]))->getConnection();
        return new self;
    }

    public static function query(string $query, array $params = []): DB
    {
        $config = config("database");
        self::$instance = self::$instance ?? (new Database($config['default']))->getConnection();
        self::$statement = self::$instance->prepare($query);
        self::$statement->execute($params);
        return new self;
    }

    public static function get(): array
    {
        return self::$statement->fetchAll();
    }

    public  static function first(): stdClass
    {
        return self::$statement->fetch();
    }

    public  static function findOrFail(): stdClass
    {
        $result = self::first();

        if (!$result) {
            die();
        }

        return $result;
    }
    public static function toArray(): array
    {
        $result = self::$statement->fetchAll(PDO::FETCH_ASSOC);
        return count($result) == 1 ? $result[0] : $result;
    }
}
