<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.class.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $buchID = $_POST['buchID'];
        echo ($username = $_SESSION['username']);

$db = DB::getInstance();

// // Odunc alinan kitabin statusu degistirildi.
$sql_buchStatus = "UPDATE buecher SET buchStatusID=2
        WHERE buchID= $buchID; ";
echo $db->update ($sql_buchStatus);

// odunc alinan kitap ausleihe tablosuna kaydedildi.
$sql_borrow = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID)
        VALUES(?, ?, ?);";
echo $db->insert($sql_borrow, array($username, $username, $buchID));

// Benutzer/Bearbeiter Email Addressini getirme
$sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
$query_email = $db->getRow($sql, [$username]);
$userEmail = $query_email['benutzerEmail'];

// Email gonderme
$message = "Sie haben von der Bibliothek der Rechtswissenschaftlichen Fakultät eine Ausleihe von Büchern erhalten.";
sendPost($message, $userEmail);
        echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
        Redirect::goTo('profile.php', 4);
}
require_once 'themes/footer.php';
?>

