<?php
session_start();
require_once 'core/init.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $buchID = $_POST['buchID'];
        echo ($username = $_SESSION['username']);
        echo ($usernameGuest = $_SESSION['usernameGuest']);
}
// Redirect::goTo('kontrol.php', 3);

$db = DB::getInstance();

// Odunc alinan kitabin statusu degistirildi.
$sql_buchStatus = "UPDATE buecher SET buchStatusID=2
        WHERE buchID= $buchID; ";
echo $db->update ($sql_buchStatus);

// odunc alinan kitap ausleihe tablosuna kaydedildi.
$sql_borrow = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID)
        VALUES(?, ?, ?);";
echo $db->insert($sql_borrow, array($usernameGuest, $username, $buchID));
?>

