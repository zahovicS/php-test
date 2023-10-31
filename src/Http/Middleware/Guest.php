<?php

namespace Src\Http\Middleware;

use Src\Auth\Auth;

class Guest
{
    public function handle()
    {
        if (Auth::check() ?? false) {
            header('location: /');
            exit();
        }
    }
}