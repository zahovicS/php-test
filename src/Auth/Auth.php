<?php

namespace Src\Auth;

use Src\Database\DB;

class Auth
{
    public function attempt(string $email,string $password): bool
    {
        $user = DB::query('SELECT * FROM usuarios WHERE email = :email', [
            'email' => $email
        ])->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->login([
                'email' => $email
            ]);

            return true;
        }

        return false;
    }

    public function login(array $user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public static function user():?array
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