<?php
session_start();
include('../controller/database.class.php');
$db = new Connection();
$db -> key();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['Rep'] =  $_GET['Rep'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db -> update_rep_data($_SESSION['Rep'], $_POST['content']);
    header('location:homepage.php');
}
echo "Artikel_Nr: {$_SESSION['Rep']}";

?>

<form action="aanvragen.php" method="post">
    <br>
    <label>Product problemen</label>
    <br>
    <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea>
    <br>
    <input type="submit" value="aanvragen">
    <a href="homepage.php">verlaten</a>
</form>
