<?php
/* session_set_cookie_params($time,$path,$domain,$secure,$httpOnly); */
session_set_cookie_params(60 * 60, '/', 'localhost', false, true); // Sunucuya yuklendikten sonra $secure true yapilmalidir.
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';


/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $username = $_POST['username'];
    echo $password = $_POST['password'];
    $db= DB::getInstance();
    $db->username=$username;
    // Hash kullan
    $sql = 'SELECT *  FROM benutzer WHERE benutzerName=? AND kontoPasswort = ? ';
    $query = $db->getRow($sql, array($username , $password));
    // foreach ($queryTable as $items) {
    print_r($query);
    echo $databaseUser = $query["benutzerName"];
    echo $databasePass = $query["kontoPasswort"]; //202cb962ac59075b964b07152d234b70

    /* Überprüfung, ob die Formularfelder nicht leer bleiben */
    if (empty($username) || empty($password)) {
        echo '<h2>Bitte geben Sie keine leeren Daten in das Formular ein</h2> <br>';
        Redirect::comeBack(1);
    } else {
        // $password = md5($_POST['password']);
        $password = $_POST['password'];
        /* Verifizierung der Benutzeridentität mit der Datenbank */
        if ($databaseUser != $username || $databasePass != $password) {
            echo '<h2>Benutzername oder Kennwort falsch</h2> <br>';
            Redirect::comeBack(3);
        } else {
            /* Anmeldung und Speichern von Session-Informationen */
            session_regenerate_id(true); // Reset session ID; Oturum sabitleme saldirisi onlenir
            $_SESSION['isLogedIn'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['sessionTime'] = time();
            echo '<h2>Basariyla giris yaptiniz. Yonlendiriliyorsunuz...</h2> <br>';
            Redirect::goTo('profile.php', 1);
        }
    }
} else {
    session_unset();
    Redirect::goTo('signin.php', 2);
    exit('<h2>Sie sind nicht berechtigt, diese Seite zu sehen!</h2>');
}

?>
  <?php require_once "themes/footer.php"; ?>