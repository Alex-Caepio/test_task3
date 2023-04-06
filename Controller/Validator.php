<?php
session_start();
require '../vendor/autoload.php';
require_once 'DbJsonCrud.php';

class Validator
{
    private DbJsonCrud $dbJsonCrud;

    public function __construct()
    {
        $this->dbJsonCrud = new DbJsonCrud('../Database/db.json');
    }

    public function validateLogin(): string
    {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        if (strlen($login) < 6) {
            return 'Login must contain at least 6 characters';
        }
        return '';
    }

    public function validateLoginPreg(): string
    {
        $user_name = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        if (!preg_match('/^\S*(?=\S{6,20})\S*$/', $user_name)) {
            return 'Login must contain only letters and numbers and be between 6 - 20 characters';
        }
        return '';
    }

    public function validatePassword(): string
    {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (strlen($password) < 6) {
            return 'Password must contain at least 6 characters';
        }
        return '';
    }

    public function validatePasswordPreg(): string
    {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (!preg_match('/^(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9]+$/', $password)) {
            return 'Password must contain at least one lower case letter and one number';
        }
        return '';
    }

    public function validateConfirmPassword(): string
    {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
        if ($password != $confirmPassword) {
            return 'Passwords do not match';
        }
        return '';
    }

    public function validateEmail(): string
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $regex = '/^\S[a-z\d]{1,64}@[^@]*[a-z\d]{1,64}\.[a-z\d]{1,7}$/';
        if (preg_match($regex, $email)) {
            return '';
        }
        return 'Email is not valid';
    }

    public function validateName(): string
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        if (strlen($name) < 2 || !preg_match('/^[a-zA-Z]+$/', $name)) {
            return 'Name must contain at least 2 letters';
        }
        return '';
    }

    public function validateLoginExists(): string
    {
        $json_data = $this->dbJsonCrud->read();

        foreach ($json_data as $user) {
            if ($user['login'] === filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING)) {
                return 'This login already exists';
            }
        }
        return '';
    }

    public function validateEmailExists(): string
    {
        $json_data = $this->dbJsonCrud->read();
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        foreach ($json_data as $user) {
            if ($user['email'] == $email) {
                return 'This email already exists';
            }
        }
        return '';
    }

    public function noSuchLogin(): string
    {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $json_data = $this->dbJsonCrud->read();

        foreach ($json_data as $user) {
            if ($user['login'] == $login) {
                return '';
            }
        }
        return 'There is no such login';
    }

    public function noSuchPassword(): string
    {
        $json_data = $this->dbJsonCrud->read();
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        foreach ($json_data as $user) {
            if ($user['password'] != '' && $user['password'] == md5($user['salt'] . $password)) {
                return '';
            }
        }
        return 'Wrong password';
    }

    public function hasErrors(): bool
    {
        if ($this->validateLogin() ||
            $this->validateLoginPreg() ||
            $this->validatePassword() ||
            $this->validatePasswordPreg() ||
            $this->validateConfirmPassword() ||
            $this->validateEmail() ||
            $this->validateName() ||
            $this->validateLoginExists() ||
            $this->validateEmailExists()) {
            return true;
        }
        return false;
    }

    public function hasAuthErrors(): bool
    {
        if ($this->noSuchLogin() ||
            $this->noSuchPassword()) {
            return true;
        }
        return false;
    }

}
