<?php

namespace App\Controllers;

class HomeController extends Controller{
    function __construct() {
    }
    public function index(){
        return view("Home.index");
    }
}