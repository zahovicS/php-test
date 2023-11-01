<?php

namespace Src\Auth;

use Src\Database\DB;

class Auth
{
    public static function attempt(string $email,string $password): bool
    {
        $user = DB::query('SELECT * FROM usuarios WHERE email = :email', [
            'email' => $email
        ])->first();
        if ($user && password_verify($password, $user->password)) {
            self::login($user);

            return true;
        }

        return false;
    }

    private static function login($user): void
    {
        $_SESSION['user'] = $user;

        session_regenerate_id(true);
    }

    public static function user():?object
    {
        return Auth::check() ? $_SESSION['user'] : null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }

    public function logout()
    {
        Session::destroy();
    }
}