<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.class.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $buchID = $_POST['buchID'];
        echo ($username = $_SESSION['username']);
        echo ($usernameGuest = $_SESSION['usernameGuest']);
        $db = DB::getInstance();
        if($_POST['selection']== "Return"){
                /* Kitap Statusunu ausgelieht olarak degistirilmesi */
                $sql_buchStatus = "UPDATE buecher SET buchStatusID=1
                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

                $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=CURRENT_DATE,
                                ausleiheStatus = 'zurückgegeben'
                                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

        }elseif($_POST['selection']=="Extend"){
                /* Kitain iade tarihini uzatma */
                $today = date("Y-m-d");
                $newDate = strtotime('1 day', strtotime($today));
                $newDate = date('d/m/Y', $newDate);
                $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=ADDDATE(CURRENT_DATE, 15),
                                ausleiheStatus = 'zurückgegeben'
                                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

        }
        // Benutzer/Bearbeiter Email adresinin veritabanindan cekilmesi.
        $sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
        $query_email = $db->getRow($sql, [$username]);
        $userEmail = $query_email['benutzerEmail'];

        // Mitarbeiter/Ausleiher Email Address
        $sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
        $query_email = $db->getRow($sql, [$usernameGuest]);
        $guestEmail = $query_email['benutzerEmail'];
        // Email gonderme
        $message = "Sie haben eine Buchrückgabe oder Buchverlängerung an die Bibliothek der Rechtswissenschaftlichen Fakultät vorgenommen.";
        sendPost($message, $userEmail, $borrowerEmail);
        /* Profil sayfasina yonlendirme */
        echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
        Redirect::goTo('profile.php', 4);
}
require_once 'themes/footer.php';
?>

