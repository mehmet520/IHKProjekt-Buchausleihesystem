<?php
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/themes/aheader.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/core/init.php";

/* Prüfen, ob eine Eingabe erfolgt ist */
// $db = DB::getInstance();
// var_dump($db);
// echo $db->usernameGuest;
// print_r($_SESSION);
// var_dump($_SESSION);
// echo $_SESSION['username'];

echo $today = date("Y-m-d");
echo "<br>";
echo $newDate = strtotime('1 day', strtotime($today));
echo "<br>";
echo $newDate = date('d/m/Y', $newDate);
echo "<br>";


?>
