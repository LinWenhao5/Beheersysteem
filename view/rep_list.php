<a href='homepage.php'>verlaten</a>
<?php
session_start();
include('../controller/database.class.php');
$db = new Connection();
$db -> key();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['done'])) {
    $content = 'geen';
    $db -> update_rep_data($_GET['done'], $content);
    header('location:homepage.php');
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