<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
require_once 'Sendpost.class.php';

/* Prüfen, ob eine Eingabe erfolgt ist */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $buchID = $_POST['buchID'];
        echo ($username = $_SESSION['username']);
                var_dump($_POST);
                echo "<br>";
        $db = DB::getInstance();
        if($_POST['selection']== "Return"){
                /* Kitap Statusunu ausgelieht olarak degistirme */
                $sql_buchStatus = "UPDATE buecher SET buchStatusID=1
                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

                $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=CURRENT_DATE,
                                ausleiheStatus = 'zurückgegeben'
                                WHERE buchID= $buchID; ";
           
        }elseif($_POST['selection']=="Extend"){
                /* Kitain iade tarihini uzatma */
                $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=ADDDATE(CURRENT_DATE, 10),
                                ausleiheStatus = 'zurückgegeben'
                                WHERE buchID= $buchID AND ausleiheStatus='in Ordnung'; ";
                echo $db->update($sql_buchStatus);
        }

        // Benutzer/Bearbeiter Email Addressini getirme
        $sql = "SELECT benutzerEmail FROM benutzer WHERE benutzerName=?;";
        $query_email = $db->getRow($sql, [$username]);
        $userEmail = $query_email['benutzerEmail'];
        // E-Mail-Versand
        $message = "Sie haben eine Buchrückgabe oder Buchverlängerung an die Bibliothek der Rechtswissenschaftlichen Fakultät vorgenommen.";
        sendPost($message, $userEmail);
        /* Profil sayfasina yonlendirme */
        echo '<div class="alert alert-success text-center" role="alert">
                    <h3>
                        Ihre Transaktion wurde bearbeitet. Sie werden jetzt geführt...
                    </h3>
                </div> <br>';
        Redirect::goTo('profile', 4);
}

require_once 'themes/footer.php';
?>

