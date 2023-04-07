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
                                SET rueckgabeDatum=ADDDATE(CURRENT_DATE),
                                ausleiheStatus = 'zurückgegeben',
                                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

        }elseif($_POST['selection']=="Extend"){
                /* Kitain iade tarihini uzatma */
                $today = date("Y-m-d");
                $newDate = strtotime('1 day', strtotime($today));
                $newDate = date('d/m/Y', $newDate);
                $sql_buchStatus = "UPDATE ausleihe 
                                SET rueckgabeDatum=ADDDATE(CURRENT_DATE, 15),
                                ausleiheStatus = 'zurückgegeben',
                                WHERE buchID= $buchID; ";
                echo $db->update($sql_buchStatus);

        }

}

?>

