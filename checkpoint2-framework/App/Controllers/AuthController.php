<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;

class AuthController extends AControllerRedirect
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function loginForm()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        $logged = Auth::login($login,$password);

        if ($logged) {
            $this->redirect('home');
        } else {
            $this->redirect('auth','loginForm', ['error' => 'The username or password is incorrect!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }
}