<?php

namespace App;

use App\Models\Account;

class Auth
{
    public static function login($login,$password)
    {
        $accounts = Account::getAll('name = ?',[$login]);
        if ($accounts[0] && password_verify($password,$accounts[0]->password)) {
            $_SESSION["name"] = $login;
            return true;
        } else {
            return false;
        }
    }

    public static function logout()
    {unset($_SESSION['name']);
       session_destroy();
    }

    public static function isLogged()
    {
        return isset($_SESSION["name"]);
    }

    public static function getName()
    {
        return (Auth::isLogged() ? $_SESSION["name"] : "");
    }
}