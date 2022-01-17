<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\Account;

class AuthController extends AControllerRedirect
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function loginForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('home');
            return;
        }

        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'succes' => $this->request()->getValue('succes')
            ]
        );
    }

    public function register() {
        if (isset($_POST['new_username'])) {
            if (strlen($_POST['new_username']) < 4) {
                $this->redirect('auth', 'loginForm', ['error' => 'Username is too short!']);
                return;
            }
            if (strlen($_POST['new_username']) > 255) {
                $this->redirect('auth', 'loginForm', ['error' => 'Username is too long!']);
                return;
            }

            $accounts = Account::getAll('name = ?', [$_POST['new_username']]);
            if ($accounts != null) {
                $this->redirect('auth', 'loginForm', ['error' => 'Username is already in use!']);
                return;
            }
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'Fill the username!']);
            return;
        }

        if (isset($_POST['new_password1']) && isset($_POST['new_password2'])) {
            if (strlen($_POST['new_password1']) < 4) {
                $this->redirect('auth', 'loginForm', ['error' => 'Password is too short!']);
                return;
            }
            if (strlen($_POST['new_password1']) > 255) {
                $this->redirect('auth', 'loginForm', ['error' => 'Password is too long!']);
                return;
            }
            if (strcmp($_POST['new_password1'],$_POST['new_password2'])) {
                $this->redirect('auth', 'loginForm', ['error' => 'Passwords have to equal!']);
                return;
            }
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'Fill the passwords!']);
            return;
        }

        $account = new Account();
        $account->name = $_POST['new_username'];
        $account->date = date('Y-m-d');
        $account->password = password_hash($_POST['new_password1'],PASSWORD_DEFAULT);
        $account->save();
        $this->redirect('auth', 'loginForm', ['succes' => 'Your registration was succesful!']);
    }

    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');
        $logged = Auth::login($login, $password);

        if ($logged) {
            $this->redirect('home');
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'The username or password is incorrect!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }
}