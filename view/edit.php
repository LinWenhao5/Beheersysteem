<?php
session_start();
include('../controller/database.class.php');
$db = new Connection();
$db -> key();
echo "product_id: {$_GET['edit']}";

$data = $db -> get_koelkast_data($_GET['edit']);
?>

<form method="post" action="edit.php">
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




