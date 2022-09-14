<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php

    use user\user;
    include('../controller/user.class.php');

    session_start();
    $user = new user();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user -> check($_POST['username'], $_POST['password']);
    }


    ?>
    <div class="login">
        <form method="post" action="index.php">
            <h1>Beheersysteem</h1>
            <p><strong>Bob Vance Koelkasten</strong></p>
            <br>
            <label for="usename">Gebruiksnaam</label><br>
            <input type="text" name="username">
            <br>
            <label for="password">Wachtwoord</label><br>
            <input type="password" name="password">
            <br><br>
            <input type="submit" value="inloggen">
        </form>
    </div>
</body>
</html>

