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
    <div class="row">
        <div class="col-sm-6">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" required>
            <p class="login_exists_error"></p>
        </div>
        <div class="col-sm-6">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <p class="password_exists_error"></p>
        </div>
    </div>
    <input type="submit" class="auth-btn" name="submit" value="Submit" required>
</form>
<script src="../assets/jquery-3.6.4.js"></script>
<script src="../assets/main.js"></script>
</body>
</html>