<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $buchID = $_POST['buchID'];
    echo $username = $_SESSION['username'];
    echo $usernameGuest = $_SESSION['usernameGuest'];
    $db = DB::getInstance();

    /* Änderung des Buchstatus auf 'ausgelieht' */
    $sql_buchStatus = "UPDATE buecher SET buchStatusID=2
                        WHERE buchID= $buchID; ";
    echo $db->update($sql_buchStatus);
    
    $today=date( 'Y-m-d' );
    $today1=strtotime($today,);
    $today2=strtotime("+20 day", $today1);
    /* Speicherung der ausgeliehenen Buchnummer in der Tabelle 'ausleihe'. */
    $rueckgabeDatum=date( 'Y-m-d', $today2);
    $sql_borrow = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID, rueckgabeDatum)
        VALUES(?, ?, ?, ?);";
    echo $db->insert($sql_borrow, array($usernameGuest, $username, $buchID, $rueckgabeDatum));

    // Extrahieren der E-Mail-Adresse des Benutzers/Bearbeiters aus der Datenbank.
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$username]);
    echo $userEmail = $query_email['benutzerEmail'];

    // Mitarbeiter/Ausleiher Email Address
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$usernameGuest]);
    echo $borrowerEmail = $query_email['benutzerEmail'];
    // E-Mail-Versand
    $message =
        'Sie haben von der Bibliothek der Rechtswissenschaftlichen Fakultät eine Ausleihe von Büchern erhalten.';
    $messageUser ="Sehr geehrter Damen und Herren " .$username . "und" . $usernameGuest .",";
    sendPost($message, $messageUser, $userEmail, $borrowerEmail);
    
    /* Weiterleitung zur Profilseite */
    echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
    Redirect::goTo('profile.php', 6);
}
require_once 'themes/footer.php';
