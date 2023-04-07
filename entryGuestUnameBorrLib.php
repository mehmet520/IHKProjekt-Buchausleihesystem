<!-- Adina islem yapilacak, personelin kullanici adinin girilmesi 
Bibliothek-Modu ; Borrow Book-->
<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/themes/aheader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/IHK_PRJ/core/init.php";
?>

<body>
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col-md-6 offset-md-3 ">
                <div class="card  mt-3 bg-light">
                    <div class="card-body ">
                        <form method="post" action="borrowLib.php">
                            <img class="mb-4 rounded mx-auto d-block" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                            <h4 class="text-primary text-center mb-5">Buchausleihsystem Bibliothek-Modus</h4>
                            <h1 class="h5 mb-5 mt-5 fw-normal">Bitte geben Sie den Benutzernamen des Mitarbeiters ein, den Sie buchen möchten.</h1>
                            <div class="form-floating h5 mb-5 fw-normal">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" placeholder="name@example.com" />
                                    <label for="floatingInput">Benutzernahme</label>
                                </div>

                                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Einreichen</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (array_key_exists('username', $_POST)) {
        echo $_SESSION['usernameGuest'] = $_POST['username'];
    }
    ?>

    <?php require_once 'themes/footer.php'; ?>