<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="image/koelkast-icoon.jpg">
    <link rel="stylesheet" href="css/style.css">
    <title>contact</title>
</head>
<body>
    <?php
    include('../controller/database.class.php');
    $db = new Connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db -> insert_contact($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['content']);
        header('location:homepage.php');
    }
    ?>
    <div class="contact">
        <form action="contact.php" method="post">
            <h1>Contact formulier</h1>
            <label>Voornaam</label><br>
            <input type="text" name="first_name"><br>
            <label>Achternaam</label><br>
            <input type="text" name="last_name"><br>
            <label>Email</label>
            <input type="email" name="email"><br>
            <label>Bericht</label>
            <br>
            <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea><br>
            <input type="submit" value="verzenden">
            <a href="homepage.php">verlaten</a>
        </form>
    </div>
</body>
</html>