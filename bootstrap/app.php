<?php

use Src\App\Container;
use Src\Database\Database;

$app = new \Src\App\Application(
    dirname(__DIR__)
);

$container = new Container();

$container->bind('Src\Database\Database', function () {
    $config = config("database");
    return new Database($config['database']);
});

$app::setContainer($container);

$app->init();

return $app;