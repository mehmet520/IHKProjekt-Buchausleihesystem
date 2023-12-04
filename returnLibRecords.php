<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $usernameGuest = $_POST['usernameGuest'];
     $selection = $_SESSION['selection'];
    echo '<br>';
     $buchID = $_SESSION['buchID'];
    echo '<br>';
    echo $username = $_SESSION['username'];
    echo '<br>';
    $db = DB::getInstance();
    if ($selection == 'Return') {
        /* Änderung des Buchstatus auf 'ausgelieht' */
        $sql_buchStatus = "UPDATE buecher SET buchStatusID='1'
                WHERE buchID= $buchID; ";
        echo $db->update($sql_buchStatus);
        // Ausleihe aktualisieren
        $today=date( 'Y-m-d' );
        $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=?,
                                ausleiheStatusID = ?          -- 5-> zurückgegeben
                                WHERE buchID= ?; ";
        echo $db->update($sql_buchStatus, array( $today, 5, $buchID)); // rueckgabeDatum
    } elseif ($selection == 'Extend') {
        /* Verlängerung der Rückgabefrist für das Buch */
        $today=date( 'Y-m-d' );
        $today=strtotime($today,);
        $today=strtotime("+20 day", $today);
        $rueckgabeDatum=date( 'Y-m-d', $today );
        // get bearbeiterID
    $sql = 'SELECT benutzerID FROM benutzer WHERE benutzerName=?;';
    $query = $db->getRow($sql, [$username]);
    $userID = $query['benutzerID'];
    // Ausleihe aktualieren
    $sql_buchStatus = "UPDATE ausleihe 
                        SET rueckgabeDatum=?,   -- today+20
                            bearbeiterID = ?,          
                            ausleiheStatusID = ?          --  in ordnung
                        WHERE buchID= ? ; ";
        echo $db->update($sql_buchStatus, array($rueckgabeDatum, $buchID, 1, $buchID));
        echo '<br>';
        // buchear update
    }
    // Extrahieren der E-Mail-Adresse des Benutzers/Bearbeiters aus der Datenbank.
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$username]);
    $userEmail = $query_email['benutzerEmail'];
    // Mitarbeiter/Ausleiher Email Address
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$usernameGuest]);
    $borrowerEmail = $query_email['benutzerEmail'];
    // E-Mail-Versand
    $message =
        'Sie haben eine Buchrückgabe oder Buchverlängerung an die Bibliothek der Rechtswissenschaftlichen Fakultät vorgenommen.';
    $messageUser =
        'Sehr geehrter Damen und Herren ' .
        $username .
        'und' .
        $usernameGuest .
        ',';
    sendPost($message, $messageUser, $userEmail, $borrowerEmail);
    /* Weiterleitung zur Profilseite */
    echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
    Redirect::goTo('profile.php', 4);
}
require_once 'themes/footer.php';
