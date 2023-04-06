<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';

if (!isset($_SESSION['isLogedIn']) && $_SESSION['isLogedIn'] === false) {
    Redirect::goTo('exit.php');
} else {
?>

    <body data-new-gr-c-s-check-loaded="14.1102.0" data-gr-ext-installed="">

        <main>
            <div class="container">
                <div class="col">

                    <div class="row">
                        <div class="px-4 py-5 my-5 text-center">
                            <img class="d-block mx-auto mb-4" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="226" height="114">
                            <h2 class="fw-bold">
                                Willkommen bei der Internen-Buchausleihesystem <br> der Rechtswissenschaftlichen Fakultät
                            </h2>
                        </div>
                    </div>
                    <div class="b-example-divider"></div>
                    <!-- Auswahl von Self-Service-Modus und Bibliothek-Modus -->
                    <div class="row" text-center>
                        <div class="col-sm-6 px-5 ">
                            <div class="btn-group-vertical ">
                                <div class="bd-example">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                        <input type="radio" class="btn-check " name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked="">
                                        <label class="btn btn-outline-success btn-lg px-4 gap-3" for="vbtn-radio1">Self-Service-Modus</label>
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                                        <label class="btn btn-outline-primary btn-lg px-4 gap-3" for="vbtn-radio2">Bibliothek-Modus</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Auswahl von Ausleihe oder Liste/Rückgabe/Verlängerung -->
                        <div class="col-sm-6">
                            <div class="d-grid gap-3 col-8 mx-auto">
                                <a class="btn btn-info btn-lg px-4 gap-3" href="#" role="button">Ausleihe</a>
                                <a class="btn btn-secondary btn-lg px-4 gap-3" href="#" role="button">Liste/Rückgabe/Verlängerung</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Auswahl von Ausloggen -->
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4"></p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-danger btn-lg px-4 gap-3" href="exit.php" role="button">Ausloggen</a>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>
        <?php require_once 'themes/footer.php'; ?>
    <?php
}
    ?>