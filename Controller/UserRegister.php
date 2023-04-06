<?php

require '../vendor/autoload.php';
require_once 'BaseController.php';

session_start();

if (!empty($_COOKIE['login'])) {
    header('Location: ../pages/Welcome.php');
}

class UserRegister extends BaseController
{
    public function register()
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            die();
        }

        if (isset($_POST['register'])) {
            $res = [
                'login_error' => $this->validator->validateLogin(),
                'login_error_preg' => $this->validator->validateLoginPreg(),
                'password_error' => $this->validator->validatePassword(),
                'password_error_preg' => $this->validator->validatePasswordPreg(),
                'confirm_password_error' => $this->validator->validateConfirmPassword(),
                'email_error' => $this->validator->validateEmail(),
                'name_error' => $this->validator->validateName(),
                'login_exists_error' => $this->validator->validateLoginExists(),
                'email_exists_error' => $this->validator->validateEmailExists(),
            ];
            echo json_encode($res);
        } else {
            return 'Error';
        }
        if ($this->validator->hasErrors()) {
            die();
        } else {
            $this->saveUser();
            header('Location: https://google.com');
        }
    }

    private function saveUser()
    {
        $salt = substr(md5(uniqid(rand(), true)), 0, 16);

        $user = [
            'id' => uniqid(rand(), true),
            'login' => filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING),
            'password' => md5($salt . filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
            'salt' => $salt
        ];

        $this->dbJsonCrud->add($user);
    }
}

$userRegister = new UserRegister();
$userRegister->register();
