<?php

use Src\Http\Request;

include_once APP_ROOT . "/vendor/autoload.php";

$app = include_once APP_ROOT . "/bootstrap/app.php";

$request = Request::capture();

dd(route());