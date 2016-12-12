<?php

namespace App\Auth;

use App\Models\User;

/**
 * 
 */
class Auth
{   
    public function user()
    {
        if(isset($_SESSION['user'])) {
            
            return User::find($_SESSION['user']);
        }
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {

        try {

            $user = User::where('email', $email)->first();

            if(password_verify($password, $user->password)) {

                $_SESSION['user'] = $user->id;

                return true;
            }

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return false;

        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}
