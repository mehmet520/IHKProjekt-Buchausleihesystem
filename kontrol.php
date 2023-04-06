<?php
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/themes/aheader.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/core/init.php";

/* Prüfen, ob eine Eingabe erfolgt ist */
    $db = DB::getInstance();
    var_dump($db);
    echo $db->usernameGuest;
?>
