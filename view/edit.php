<?php
session_start();
include('../controller/database.class.php');
$db = new Connection();
$user = $db -> get_user();
if ($_SESSION['key'] !== $user[0]['user_key']) {
    header('location:index.php');
    exit;
}
?>