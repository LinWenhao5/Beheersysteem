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
    <div class="top">
        <form action="homepage.php" method="post">
            <label>Sorteren op:</label>
            <select name="sorteren">
                <option value="A">Prijs(van hoog naar laag)</option>
                <option value="B">Prijs(van laag naar hoog)</option>
                <option value="C">netto inhoud(van hoog naar laag)</option>
                <option value="D">netto inhoud(van laag naar hoog)</option>
                <option value="E">energie-label(A-G)</option>
                <option value="F">energie-label(G-A)</option>
            </select>
            <input type="submit" value="sorteren">
        </form>
        <a href="rep_list.php">Reparatielijst</a>
        <a href="contact.php">Contact</a>
        <a href="index.php">Uitloggen</a>
    </div>
    <hr>
    <div class="container">
    <?php
    session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    $db -> key();
    $sql =  "SELECT * FROM koelkast";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sorteren'])) {
        switch ($_POST['sorteren']) {
            case "A":
                $sql = "SELECT * FROM koelkast ORDER BY Prijs DESC";
                break;
            case "B":
                $sql = "SELECT * FROM koelkast ORDER BY Prijs ASC";
                break;
            case "C":
                $sql = "SELECT * FROM koelkast ORDER BY Inhoud DESC";
                break;
            case "D":
                $sql = "SELECT * FROM koelkast ORDER BY Inhoud ASC";
                break;
            case "E":
                $sql = "SELECT * FROM koelkast ORDER BY Energie ASC";
                break;
            case "F":
                $sql = "SELECT * FROM koelkast ORDER BY Energie DESC";
                break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content'])) {
        $time = date("h:i:sa");
        $rep = 'geen';
        $db->insert_koelkast(
            $db -> user,
            $_POST['koelkast'],
            $_POST['content'],
            $_POST['artikelnummer'],
            intval($_POST['prijs']),
            $_POST['energie'],
            intval($_POST['inhoud']),
            $rep,
            $time
        );
        if (isset($_POST['verzekering_A'])) {
            $db->insert_inner_j($_POST['artikelnummer'], $_POST['verzekering_A']);
        }
        if (isset($_POST['verzekering_B'])) {
            $db->insert_inner_j($_POST['artikelnummer'], $_POST['verzekering_B']);
        }
        if (isset($_POST['verzekering_C'])) {
            $db->insert_inner_j($_POST['artikelnummer'], $_POST['verzekering_C']);
        }
        header("Refresh:0");
    }
    echo '<div class="child_one">';
    foreach ($db->get_koelkast_data($sql) as $row) {
        echo /** @lang text */
        "<div class='child'>
            <p>USER:<strong>{$row['User']}</strong><br>
                  KOELKAST: <strong>{$row['Koelkast']}</strong><br>
                  BESCHRIJVING: <strong>{$row['Content']}</strong><br>
                  ARTIKEL_NR: <strong>{$row['Artikelnummer']}</strong><br>
                  PRIJS(euro): <strong>{$row['Prijs']}</strong><br>
                  ENERGIE_LABEL: <strong>{$row['Energie']}</strong><br>
                  NETTO_INHOUD(L): <strong>{$row['Inhoud']}</strong><br>
                  UPDATE_TIME: <strong>{$row['Time']}</strong><br>
                  </p>
                  <strong>Verzekering(en):</strong>";
        foreach ($db->get_all_data() as $verzekering) {
            if ($row['Artikelnummer'] == $verzekering['Artikelnummer']) {
                echo"<p>{$verzekering['naam']}</p>";
            }
        }
        if ($row['Reparatie'] == 'geen') {
            echo "<a href='aanvragen.php?Rep={$row['Artikelnummer']}'>Reparatie aanvraag </a>";
        } else {
            echo"<p><strong>Reden voor reparatie:</strong></p>
                      <p>{$row['Reparatie']}</p>";
        }
        echo /** @lang text */
        "<a href='homepage.php?Del={$row['Artikelnummer']}'>Verwijderen</a>
                    <a href='edit.php?edit={$row['Artikelnummer']}'>edit</a>";
        echo "<HR></div>";
    }
    ?>
    </div>

    <form class="child_two" method="post" action="homepage.php">
        <h1>Toevoegen</h1>
        <label for="koelkast">Koelkast:</label>
        <input type="text" name="koelkast">
        <br><br>
        <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea>
        <br><br>
        <label for="artikelnummer">Artikel_nummer(mogen niet hetzelfde!):</label>
        <input type="text" name="artikelnummer">
        <br><br>
        <label for="prijs">prijs:</label>
        <input type="number" name="prijs">
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
        <input type="number" name="inhoud">
        <br><br>
        <input type="checkbox" name="verzekering_A" value="1">
        <label for="vehicle1">verzekering_A</label><br>
        <input type="checkbox" name="verzekering_B" value="2">
        <label for="vehicle2">verzekering_B</label><br>
        <input type="checkbox" name="verzekering_C" value="3">
        <label for="vehicle3">verzekering_C</label>
        <br><br>
        <input type="submit" value="verzenden">
    </form>
</div>

</body>
</html>



