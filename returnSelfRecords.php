<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $buchID = $_POST['buchID'];
    echo '<br>';
    echo $username = $_SESSION['username'];
    echo '<br>';
    $db = DB::getInstance();
    if ($_POST['selection'] == 'Return') {
        /* Änderung des Buchstatus auf 'ausgelieht' */
        $sql_buchStatus = "UPDATE buecher SET buchStatusID=1
                WHERE buchID= $buchID; ";
        echo $db->update($sql_buchStatus);
        echo '<br>';
    // Ausleihe aktualisieren
        $today=date( 'Y-m-d' );
        $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=?,
                                ausleiheStatusID = ?          -- 5-> zurückgegeben
                                WHERE buchID= ?; ";
        echo $db->update($sql_buchStatus, array( $today, 5, $buchID)); // rueckgabeDatum
    } elseif ($_POST['selection'] == 'Extend') {
        /* Verlängerung der Rückgabefrist für das Buch */
        // ausleihe update
        $today=date( 'Y-m-d' );
        $today=strtotime($today,);
        $today=strtotime("+10 day", $today);
        $rueckgabeDatum=date( 'Y-m-d', $today );
    // get bearbeiterID
    $sql = 'SELECT benutzerID FROM benutzer WHERE benutzerName=?;';
    $query = $db->getRow($sql, [$username]);
    $userID = $query['benutzerID'];
    // Ausleihe aktualieren
    $sql_buchStatus = "UPDATE ausleihe 
                        SET rueckgabeDatum=?,   -- today+20
                            bearbeiterID = ?,          
                            ausleiheStatusID = ?          -- buchStatus unverändert -> in ordnung
                        WHERE buchID= ? ; ";
        echo $db->update($sql_buchStatus, array( $rueckgabeDatum, $userID, 1, $buchID));
        echo '<br>';
    }
    // Benutzer/Bearbeiter Email Addressini getirme
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$username]);
    $userEmail = $query_email['benutzerEmail'];

    // E-Mail-Versand
    $message =
        'Sie haben eine Buchrückgabe oder Buchverlängerung an die Bibliothek der Rechtswissenschaftlichen Fakultät vorgenommen.';
    $messageUser =
        'Sehr geehrter Damen und Herren ' . $username . ',';
    sendPost($message, $messageUser, $userEmail);
    /* Weiterleitung zur Profilseite */
    echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
    Redirect::goTo('profile.php', 4);
}
require_once 'themes/footer.php';
?>

