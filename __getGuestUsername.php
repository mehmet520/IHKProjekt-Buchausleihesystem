<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/themes/aheader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/core/init.php";


/* Prüfen, ob eine Eingabe erfolgt ist */

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = DB::getInstance();
    // sil
    echo $usernameGuest = $_POST['username'];

    if (empty($usernameGuest)) {
        echo '<div class="alert alert-danger text-center" role="alert">
        <h3>
        Bitte geben Sie keine leeren Daten in das Formular ein!
        </h3>
        </div> <br>';
        Redirect::comeBack(2);
    } else {
        $_SESSION['usernameGuest'] = $usernameGuest;
        $db->usernameGuest = $usernameGuest;
        echo '<h2>Basariyla giris yaptiniz. Yonlendiriliyorsunuz...</h2> <br>';
        // sil
        echo  $_SESSION['usernameGuest'];
        echo $db->usernameGuest;
        Redirect::goTo('borrowLib.php', 3);
        // header("Refresh:6; borrowLibRecord");
    }
}

?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>