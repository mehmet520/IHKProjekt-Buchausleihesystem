<?php
header("Location: borrowLibRediCont.php");
echo htmlspecialchars("borrowLibRediCont.php");
Redirect::goTo('borrowLibRediCont.php', 2);
Redirect::goTo(__DIR__ . "/functions/borrowLibRediCont.php", 2);
?>

<?php
$db = DB::getInstance();

if (array_key_exists('signature', $_POST)) {
    echo $bookSignature = $_POST['signature'];
    ausleihe();
}

function ausleihe()
{
    print_r($_POST);
}


$db = DB::getInstance();
echo $usernameGuest = $db->usernameGuest;
$sqlGuestId = "SELECT benutzerID FROM benutzer WHERE benutzerName = $usernameGuest;";
$ausleiherID = $db->getRows($sqlGuestId);
print_r($ausleiherID);


echo $bookSignature = $db->username;




$sql_buchStatus = "UPDATE buecher SET buchStatusID=2
        WHERE signatur= $bookSignature; ";
// $queryTable = $db->update ($sql_buchStatus);

$sql_buchStatus = "INSERT INTO ausleihe (ausleiherID, bearbeiterID, buchID)
        VALUES(?, ?, ?)";

?>

    <?php
    $usernameGuest;
    $bookSignature;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $usernameGuest = $_POST['username'];
        if (empty($usernameGuest)) {
            echo '<div class="alert alert-danger text-center" role="alert">
                    <h3>
                        Bitte geben Sie keine leeren Daten in das Formular ein!
                    </h3>
                </div> <br>';
            Redirect::comeBack(2);
        } else {
            // echo $usernameGuest = $_POST['username'];    
            Redirect::goTo('borrowLib.php', 1);
        }
    }
    function ausleihe()
    {
        print_r($_POST);
    }
    ?>