<!-- Eingabe des Benutzernamens des Personals, in dessen Namen die Transaktion durchgeführt werden soll 
Bibliothek-Modu ; Return Book-->

<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';

echo $_SESSION['selection'] = $_POST['selection'];
echo $_SESSION['buchID'] = $_POST['buchID'];

?>

<body>
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col-md-6 offset-md-3 ">
                <div class="card  mt-3 bg-light">
                    <div class="card-body ">
                        <form method="post" action="returnLibRecords.php">
                            <img class="mb-4 rounded mx-auto d-block" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                            <h4 class="text-primary text-center mb-5">Buchausleihsystem Bibliothek-Modus</h4>
                            <h1 class="h5 mb-5 mt-5 fw-normal">Bitte geben Sie den Benutzernamen des Mitarbeiters ein, für den Sie den Vorgang bearbeiten möchten.</h1>
                            <div class="form-floating h5 mb-5 fw-normal">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="usernameGuest" placeholder="name@example.com" />
                                    <label for="floatingInput">Benutzernahme</label>
                                </div>
                                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Einreichen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once 'themes/footer.php'; ?>