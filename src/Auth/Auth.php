<?php

namespace Src\Auth;

use Src\Database\Query;
use stdClass;

class Auth
{
    public static function attempt(array $credentials, $table_middleware = "usuarios"): bool
    {
        $result = (new Query)->table($table_middleware);
        foreach ($credentials as $key => $credential) {
            if($key != "contrasena"){
                $result->where($key,"=",$credential);
            }
        }
        $user = $result->first();
        if ($user && $credentials["contrasena"] && password_verify($credentials["contrasena"], $user->contrasena)) {
            self::login($user,$table_middleware);
            return true;
        }

        return false;
    }

    private static function login($user,string $middleware = "usuarios"): void
    {
        $_SESSION[$middleware] = $user;

        session_regenerate_id(true);
    }

    public static function update(stdClass $user,$middleware = "usuarios"){
        $_SESSION[$middleware] = $user;
    }

    public static function user(string $middleware = "usuarios"):?stdClass
    {
        return Auth::check($middleware) ? $_SESSION[$middleware]  : null;
    }

    public static function check(string $middleware = "usuarios"): bool
    {
        return isset($_SESSION[$middleware]) && !empty($_SESSION[$middleware]);
    }

    public function logout()
    {
        Session::destroy();
    }
}