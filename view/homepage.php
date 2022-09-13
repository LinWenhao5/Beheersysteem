
<?php

session_start();
    include('../controller/database.class.php');
    $db = new Connection();
    $db -> key();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content'])) {
        $time = date("h:i:sa");
        $db->insert_koelkast(
                $db -> user,
                $_POST['koelkast'],
                $_POST['content'],
                $_POST['artikelnummer'],
                $_POST['prijs'],
                $_POST['energie'],
                $_POST['inhoud'],
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
    foreach ($db->get_koelkast_data() as $row) {
        echo /** @lang text */
        "<p>USER:<strong>{$row['User']}</strong><br>
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
        echo /** @lang text */
        "<a href='homepage.php?Del={$row['Artikelnummer']}'>Verwijderen</a>
                <a href='edit.php?edit={$row['Artikelnummer']}'>edit</a>";
        echo "<HR>";
    }
    ?>


    <form method="post" action="homepage.php">
        <h1>Toevoegen</h1>
        <label for="koelkast">Koelkast:</label>
        <input type="text" name="koelkast">
        <br><br>
        <textarea name="content" rows="4" cols="50" placeholder="Beschrijving"></textarea>
        <br><br>
        <label for="artikelnummer">Artikel_nummer:</label>
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
