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
    
    public function user():?array
    {
        return isset($_SESSION['user']) && !empty($_SESSION['user']) ?? null;
    }

    public function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public function logout()
    {
        Session::destroy();
    }
}