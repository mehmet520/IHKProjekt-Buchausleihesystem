<?php
session_start();
require_once 'core/init.php';

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

}

?>

