<?php

require '../vendor/autoload.php';
require_once 'BaseController.php';

session_start();

if (!empty($_COOKIE['login'])) {
    header('Location: ../pages/Welcome.php');
}

class LoginUser extends BaseController
{
    public function login()
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            die();
        }

        if (isset($_POST['login'])) {
            $res = [
                'login_exists_error' => $this->validator->noSuchLogin(),
                'password_exists_error' => $this->validator->noSuchPassword(),
            ];
            echo json_encode($res);
        } else {
            return 'Error';
        }
        if ($this->validator->hasAuthErrors()) {
            die();
        } else {
            $this->checkUser();
        }
    }

    private function checkUser()
    {
        if ($this->validator->hasAuthErrors()) {
            die();
        } else {
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            setcookie('login', $login, time() + 3600, '/');
        }
    }

}

$userLogin = new LoginUser();
$userLogin->login();
