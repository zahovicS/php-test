<?php

use App\Controllers\HomeController;
use Src\Http\Request;

$router->get('/', [HomeController::class,"index"]);

$router->get('/logout', function(){
    auth()->logout();
    return redirect(route("/"));
});

$router->get('/dashboard', function(Request $request){
    return view("dashboard.index");
})->only("auth");