<?php

use Src\Auth\Session;
use Src\Http\Router;

define('APP_ROOT',dirname(__DIR__));

include_once APP_ROOT . "/vendor/autoload.php";

session_start();

$app = include_once APP_ROOT . "/bootstrap/app.php";

$router = new Router();

include_once APP_ROOT . "/web/routes.php";

$uri = cleanUri($_GET['url'] ?? "/");

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

Session::unflash();