<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
?>
<?php
echo md5("1_kontoPasswort") . "<br>";
echo md5("2_kontoPasswort") . "<br>";
echo md5("3_kontoPasswort") . "<br>";
echo md5("4_kontoPasswort") . "<br>";
echo md5("5_kontoPasswort");

 
$db = DB::getInstance();
$sqlGuestId= "SELECT benutzerID FROM benutzer WHERE benutzerName = $usernameGuest";
        $ausleiherID = $db->getRow($sqlGuestId);
print_r($ausleiherID);