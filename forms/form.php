<?php
session_start();

if (!empty($_COOKIE['login'])) {
    header('Location: ../pages/Welcome.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Document</title>
</head>
<body>
<form>
    <div class="columns">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required>
        <p class="login_error"></p>
        <p class="login_error_preg"></p>
        <p class="login_exists_error"></p>
    </div>
    <div class="columns">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <p class="password_error"></p>
        <p class="password_error_preg"></p>
    </div>
    <div class="columns">
        <label for="confirm_password">Confirm password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <p class="confirm_password_error"></p>
    </div>
    <div class="columns">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <p class="email_error"></p>
        <p class="email_exists_error"></p>
    </div>
    <div class="columns">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <p class="name_error"></p>
    </div>

    <div class="columns">
        <input type="submit" class="register-btn" name="register" value="Register" required>
    </div>
</form>
<script src="../assets/jquery-3.6.4.js"></script>
<script src="../assets/main.js"></script>
</body>
</html>










