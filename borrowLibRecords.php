<?php
session_start();
require_once 'core/init.php';
require_once 'Sendpost.class.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $buchID = $_POST['buchID'];
        echo ($username = $_SESSION['username']);
        echo ($usernameGuest = $_SESSION['usernameGuest']);
// Redirect::goTo('kontrol.php', 3);

$db = DB::getInstance();

// // Odunc alinan kitabin statusu degistirildi.
// $sql_buchStatus = "UPDATE buecher SET buchStatusID=2
//         WHERE buchID= $buchID; ";
// echo $db->update ($sql_buchStatus);

// // odunc alinan kitap ausleihe tablosuna kaydedildi.
// $sql_borrow = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID)
//         VALUES(?, ?, ?);";
// echo $db->insert($sql_borrow, array($usernameGuest, $username, $buchID));
}
// Benutzer/Bearbeiter Email Address
$sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
$query_email = $db->getRow($sql, [$username]);
$userEmail = $query_email['benutzerEmail'];

// Mitarbeiter/Ausleiher Email Address
$sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
$query_email = $db->getRow($sql, [$usernameGuest]);
$guestEmail = $query_email['benutzerEmail'];

$message = "Hukuk Fakultesi kutuphanesindan odunc kitap alma islemi gerceklestirdiniz.";
sendPost($message, $userEmail, $borrowerEmail);

?>