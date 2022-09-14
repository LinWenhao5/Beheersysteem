<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Aanvragen</title>
</head>
<body>
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
    ?>
    <div class="aanvragen">
        <form action="aanvragen.php" method="post">
            <p>Artikel_Nr:<?php echo $_SESSION['Rep'] ?></p>
            <h1>Aanvraag formulier</h1>
            <br>
            <label>Product problemen</label>
            <br>
            <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea>
            <br>
            <input type="submit" value="aanvragen">
            <a href="homepage.php">verlaten</a>
        </form>
    </div>
</body>
</html>

