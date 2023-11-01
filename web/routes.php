<?php

use App\Controllers\HomeController;
use Src\Http\Request;
use Src\Http\Response;

$router->get('/', [HomeController::class,"index"]);

$router->get('/logout', function(){
    auth()->logout();
    return redirect(route("/"));
});

$router->get('/dashboard', function(Request $request){
    return view("dashboard.index");
})->only("auth");

$router->get('/users', function(){
    return Response::json(["users" => [1,2,3,4,5]]);
})->only("auth");