<?php
    require_once 'themes/header.php';
    require_once 'core/init.php';
    // require_once '/functions/borrowLibRediCont.php';

?>

<body>
    <!-- <h1>Hello,</h1> -->
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col-md-6 offset-md-3 ">
                <div class="card  mt-3 bg-light">
                    <div class="card-body ">

                        <form method="post" action="
                                            <?php
                                            echo htmlspecialchars("borrowLibRediCont.php");
                                        // Redirect::goTo('borrowLibRediCont.php', 2);
                                            ?>
                                            ">
                            <img class="mb-4 rounded mx-auto d-block" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                            <h4 class="text-primary text-center mb-5">Buchausleihsystem Bibliothek-Modus</h4>
                            <h1 class="h5 mb-5 mt-5 fw-normal">Bitte geben Sie den Benutzernamen des Mitarbeiters ein, den Sie buchen möchten.</h1>
                            <div class="h5 mb-5 fw-normal">

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" />
                                    <label for="floatingInput">Benutzernahme</label>
                                </div>

                                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Einreichen</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Adina odunc kitap alinacak personelin kullanici adinin girilmesi -->


    <?php
    // $usernameGuest;
    // $bookSignature;
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     echo $usernameGuest = $_POST['username'];
    //     if (empty($usernameGuest)) {
    //         echo '<div class="alert alert-danger text-center" role="alert">
    //                 <h3>
    //                     Bitte geben Sie keine leeren Daten in das Formular ein!
    //                 </h3>
    //             </div> <br>';
    //         Redirect::comeBack(2);
    //     } else {
    //         // echo $usernameGuest = $_POST['username'];    
    //         Redirect::goTo('borrowLib.php', 1);
    //     }
    // }
    function ausleihe()
    {
        print_r($_POST);
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once 'themes/footer.php'; ?>