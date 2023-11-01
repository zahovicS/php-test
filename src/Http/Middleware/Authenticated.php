<?php

namespace Src\Http\Middleware;

use Src\Auth\Auth;

class Authenticated
{
    public function handle()
    {
        if (!Auth::check() ?? false) {
            redirect(route("/"));
        }
    }
}