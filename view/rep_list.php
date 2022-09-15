<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/koelkast-icoon.jpg">
    <title>Reparatielijst</title>
</head>
<body>
    <a href='homepage.php'>verlaten</a>
    <?php
    session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    $db -> key();
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['done'])) {
        $content = 'geen';
        $db -> update_rep_data($_GET['done'], $content);
        header('location:rep_list.php');
    }
    foreach ($db->get_rep_data() as $row) {
        echo "<p>product naam: <strong>{$row['Koelkast']}</strong></p>
              <p>Artikel_Nr: <strong>{$row['Artikelnummer']}</strong></p>
              <p>Reden voor reparatie: <strong>{$row['Reparatie']}</strong></p>
              <a href='rep_list.php?done={$row['Artikelnummer']}'>Gerepareerd</a>
              <hr>
    ";
    }
    ?>
</body>
</html>