<?php

use Src\Http\Request;

include_once APP_ROOT . "/vendor/autoload.php";

include_once APP_ROOT . "/bootstrap/app.php";

$request = Request::capture();
dd($request);