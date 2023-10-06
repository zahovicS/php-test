<?php

use Src\Http\Request;
use Src\Http\Response;

include_once APP_ROOT . "/vendor/autoload.php";

include_once APP_ROOT . "/bootstrap/app.php";

$request = Request::capture();
return Response::json(["asdsad"=>"asdsañññd"],200,['Content-Length' => 1]);