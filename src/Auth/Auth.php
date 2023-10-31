<?php

namespace Src\Auth;

use Src\Database\DB;

class Auth
{
    public function attempt($email, $password)
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

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}