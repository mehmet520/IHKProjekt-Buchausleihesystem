<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $buchID = $_POST['buchID'];
    echo $username = $_SESSION['username'];

    $db = DB::getInstance();
    /* Änderung des Buchstatus auf 'ausgelieht' */
    $sql_buchStatus = "UPDATE buecher SET buchStatusID=2
        WHERE buchID= $buchID; ";
    echo $db->update($sql_buchStatus);
    $today=date( 'Y-m-d' );
    $today=strtotime($today,);
    $today=strtotime("+20 day", $today);
    $rueckgabeDatum=date( 'Y-m-d', $today );
    /* Speicherung der ausgeliehenen Buchnummer in der Tabelle 'ausleihe'. */
    $sql_borrow = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID, rueckgabeDatum)
        VALUES(?, ?, ?, ?);";
    echo $db->insert($sql_borrow, [$username, $username, $buchID, $rueckgabeDatum]);

    // Extrahieren der E-Mail-Adresse des Benutzers/Bearbeiters aus der Datenbank.
    $sql = 'SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;';
    $query_email = $db->getRow($sql, [$username]);
    $userEmail = $query_email['benutzerEmail'];

    // E-Mail-Versand
    $message =
        'Sie haben von der Bibliothek der Rechtswissenschaftlichen Fakultät eine Ausleihe von Büchern erhalten.';
    $messageUser =
        'Sehr geehrter Damen und Herren ' . $_SESSION['username'] . ',';
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
