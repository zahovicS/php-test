<?php

namespace Src\Http\Middleware;

class Authenticated
{
    public function handle()
    {
        if (! $_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}