<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wijzigen</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/koelkast-icoon.jpg">
</head>
<body>
    <?php
    session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    $db -> key();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $_SESSION['edit'] =  $_GET['edit'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db->update_data($_SESSION['edit'], $_POST['koelkast'], $_POST['content'],  $_POST['prijs'], $_POST['energie'], $_POST['inhoud'], $_POST['Conditie']);
        $db->clear_v_data($_SESSION['edit']);
        if (isset($_POST['verzekering_A'])) {
            $db->insert_inner_j($_SESSION['edit'], $_POST['verzekering_A']);
        }
        if (isset($_POST['verzekering_B'])) {
            $db->insert_inner_j($_SESSION['edit'], $_POST['verzekering_B']);
        }
        if (isset($_POST['verzekering_C'])) {
            $db->insert_inner_j($_SESSION['edit'], $_POST['verzekering_C']);
        }
        header('location:homepage.php');
    }
    $data = $db -> get_one_koelkast($_SESSION['edit']);
    ?>
    <div class="edit">
    <form method="post" action="edit.php">
        <p>Artikel_Nr: <?php echo $_SESSION['edit'] ?></p>
        <h1>Wijzig</h1>
        <label for="koelkast">Koelkast:</label>
        <input type="text" name="koelkast" value="<?php echo $data[0]["Koelkast"] ?>">
        <br><br>
        <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"><?php echo $data[0]["Content"] ?></textarea>
        <br><br>
        <label for="prijs">prijs:</label>
        <input type="number" name="prijs" value="<?php echo $data[0]["Prijs"] ?>">
        <br><br>
        <label for="Energie-label">Energie-label:</label>
        <select name="energie">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select>
        <br><br>
        <label for="inhoud">Netto_inhoud (liter):</label>
        <input type="number" name="inhoud" value="<?php echo $data[0]["Inhoud"] ?>"">
        <br><br>
        <label for="Conditie">Conditie</label>
        <select name="Conditie">
            <option value="Nieuw">Nieuw</option>
            <option value="Gebruikt">Gebruikt</option>
        </select>
        <br><br>
        <input type="checkbox" name="verzekering_A" value="1">
        <label for="vehicle1">verzekering_A</label><br>
        <input type="checkbox" name="verzekering_B" value="2">
        <label for="vehicle2">verzekering_B</label><br>
        <input type="checkbox" name="verzekering_C" value="3">
        <label for="vehicle3">verzekering_C</label>
        <br><br>
        <input type="submit" value="verzenden">
        <a href="homepage.php">verlaten</a>
    </form>
    </div>
</body>
</html>





