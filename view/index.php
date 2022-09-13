<?php

use user\user;
include('../controller/user.class.php');

session_start();
$user = new user();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user -> check($_POST['username'], $_POST['password']);
}


?>

<form method="post" action="index.php">
    <label for="usename">账号</label>
    <input type="text" name="username">
    <br>
    <label for="password">密码</label>
    <input type="password" name="password">
    <br>
    <input type="submit" value="发送">
</form>
