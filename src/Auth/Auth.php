<?php

namespace Src\Auth;

use Src\Database\DB;
use Src\Database\Query;

class Auth
{
    public static function attempt(array $credentials, $table_middleware = "users"): bool
    {
        $result = (new Query)->table($table_middleware);
        foreach ($credentials as $key => $credential) {
            if($key != "password"){
                $result->where($key,"=",$credential);
            }
        }
        $user = $result->first();
        if ($user && $credentials["password"] && password_verify($credentials["password"], $user->password)) {
            self::login($user,$table_middleware);

            return true;
        }

        return false;
    }

    private static function login($user,string $middleware = "user"): void
    {
        $_SESSION[$middleware] = $user;

        session_regenerate_id(true);
    }

    public static function user(string $middleware = "user"):?object
    {
        return Auth::check($middleware) ? $_SESSION[$middleware] : null;
    }

    public static function check(string $middleware = "user"): bool
    {
        return isset($_SESSION[$middleware]) && !empty($_SESSION[$middleware]);
    }

    public function logout()
    {
        Session::destroy();
    }
}