
<?php

session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content'])) {
        $time = date("h:i:sa");
        $db->insert(
                $user[0]['user'],
                $_POST['koelkast'],
                $_POST['content'],
                $_POST['artikelnummer'],
                $_POST['prijs'],
                $_POST['energie'],
                $_POST['inhoud'],
                $time
        );
        header("Refresh:0");
    }
    foreach ($db->get_data() as $row) {
        echo "<p>USER:<strong>{$row['User']}</strong><br>
              KOELKAST: <strong>{$row['Koelkast']}</strong><br>
              BESCHRIJVING: <strong>{$row['Content']}</strong><br>
              ARTIKEL_NR: <strong>{$row['Artikelnummer']}</strong><br>
              PRIJS(euro): <strong>{$row['Prijs']}</strong><br>
              ENERGIE_LABEL: <strong>{$row['Energie']}</strong><br>
              NETTO_INHOUD(L): <strong>{$row['Inhoud']}</strong><br>
              UPDATE_TIME: <strong>{$row['Time']}</strong><br>
              </p>";
        echo "<a href='homepage.php?Del={$row['ID']}'>Verwijderen</a> <a href='edit.php?Edit={$row['ID']}'>Wijzigen</a>";
        echo "<HR>";
    }
    ?>


    <form method="post" action="homepage.php">
        <h1>Toevoegen</h1>
        <label for="koelkast">Koelkast:</label>
        <input type="text" name="koelkast">
        <br><br>
        <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea>
        <input type="hidden" name="content" value="test">
        <br><br>
        <label for="artikelnummer">Artikel_nummer:</label>
        <input type="text" name="artikelnummer">
        <br><br>
        <label for="prijs">prijs:</label>
        <input type="number" name="prijs">
        <br><br>
        <label for="cars">Energie-label:</label>
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
        <input type="submit" value="verzenden">
    </form>
