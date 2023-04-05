<?php
require_once 'core/init.php';

$usernameGuest;
$bookSignature;
/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($usernameGuest)) {
        echo '<div class="alert alert-danger text-center" role="alert">
                    <h3>
                        Bitte geben Sie keine leeren Daten in das Formular ein!
                    </h3>
                </div> <br>';
        Redirect::comeBack(2);
    } else {
        echo '<h2>Basariyla giris yaptiniz. Yonlendiriliyorsunuz...</h2> <br>';
        $_SESSION['usernameGuest'] = $usernameGuest;
        echo $usernameGuest = $_POST['username'] . "<br>";
        Redirect::goTo('borrowLib.php', 2);
    }
}
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>