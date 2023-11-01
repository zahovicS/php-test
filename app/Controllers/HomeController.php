<?php

namespace App\Controllers;

use Src\Http\Request;

class HomeController extends Controller{
    public function index(){
        return view("Home.index");
    }
}