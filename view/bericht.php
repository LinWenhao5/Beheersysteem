<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>berichten</title>
    <link rel="icon" type="image/x-icon" href="image/koelkast-icoon.jpg">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href='homepage.php'>verlaten</a>
    <?php
    session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    $db -> key();
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['gelezen'])) {
        $db -> clear_b_data($_GET['gelezen']);
        header('location:bericht.php');
    }
    foreach ($db->get_contact_data() as $row) {
        echo "<p>Voornaam: <strong>{$row['Voornaam']}</strong></p>
                  <p>Achternaam: <strong>{$row['Achternaam']}</strong></p>
                  <p>Email: <strong>{$row['Email']}</strong></p>
                  <p>Bericht: <strong>{$row['Bericht']}</strong></p>
                  <a href='bericht.php?gelezen={$row['ID']}'>Verwijderen</a>
                  <hr>
        ";
    }
    ?>
</body>
</html>