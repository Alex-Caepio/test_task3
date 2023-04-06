<?php

if (empty($_COOKIE['login'])) {
    header('Location: auth_form.php');
}

echo '<h1>Welcome ' . $_COOKIE['login'] . '</h1>';

?>


<form action="LogOut.php" method="post">
    <input type="submit" value="Log Out">
</form>


