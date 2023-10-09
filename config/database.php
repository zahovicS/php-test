<?php

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'garota',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8mb4',
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::CASE_LOWER => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]) : [],
    ],
];