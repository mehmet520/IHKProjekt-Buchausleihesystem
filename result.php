<?php
/* session_set_cookie_params($time,$path,$domain,$secure,$httpOnly); */
session_set_cookie_params(60 * 60, '/', 'localhost', false, true); // Nach dem Hochladen auf den Server muss $secure true sein.
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $username = $_POST['username'];
    echo $password = $_POST['password'];
    /* Überprüfung, ob die Formularfelder nicht leer bleiben */
    if (empty($username) || empty($password)) {
        echo '<h2>Bitte geben Sie keine leeren Daten in das Formular ein</h2> <br>';
        Redirect::comeBack(3);
    } else {
        $password = Hash::encode_sha256($password);
        /* Verifizierung der Benutzeridentität mit der Datenbank */
        $db = DB::getInstance();
        $sql = "SELECT benutzerName, kontoPasswort, bibliothekID FROM benutzer 
                INNER JOIN einrichtungen USING(einrichtungID) 
                INNER JOIN bibliotheken bi USING(bibliothekID) 
                WHERE benutzerName=? AND kontoPasswort = ?;";
        $query = $db->getRow($sql, array($username, $password));
        echo $databaseUser = $query["benutzerName"];
         $databasePass = $query["kontoPasswort"]; //6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b
         $databaseLibr = $query["bibliothekID"];
        if ($databaseUser != $username || $databasePass != $password) {
            echo '<h2>Benutzername oder Kennwort falsch</h2> <br>';
            Redirect::comeBack(15);
        } else {
            /* Anmeldung und Speichern von Session-Informationen */
            session_regenerate_id(true); // Reset session ID;
            $_SESSION['isLogedIn'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['library'] = $databaseLibr;
            $_SESSION['sessionTime'] = time();
            echo '<h2>Basariyla giris yaptiniz. Yonlendiriliyorsunuz...</h2> <br>';
            Redirect::goTo('profile.php', 2);
        }
    }
} else {
    session_unset();
    Redirect::goTo('signin.php', 2);
    exit('<h2>Sie sind nicht berechtigt, diese Seite zu sehen!</h2>');
}

?>
  <?php require_once "themes/footer.php"; ?>