<?php
session_start();
require_once 'themes/header.php';
require_once 'core/init.php';

?>

<body>
    <h1>Hello,</h1>
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col">
                <div class="card mt-3 bg-light">
                    <div class="card-body ">
                        <?php  ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Signatur</th>
                                        <th scope="col">Buchtitle</th>
                                        <th scope="col">Autorenname</th>
                                        <th scope="col">Autorennahcname</th>
                                        <!-- <th scope="col">Datum</th> -->
                                        <th scope="col">Bibliothekname</th>
                                        <th scope="col">Buchstandort</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $db = DB::getInstance();
                                    $sql = "SELECT benutzerName, buchID, signatur, buchTitel, autorVorname, autorNachname, bibliothekName, standortBezeichnung
                                            FROM buecher bu
                                            INNER JOIN bibliotheken bi USING(bibliothekID)
                                            INNER JOIN standorte st USING(bibliothekID)
                                            INNER JOIN ausleihe au USING (buchID)
                                            INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID;";
                                    // -- WHERE benutzerName='3_benutzerName';";
                                    $queryTable = $db->tableOperations(
                                        $sql,
                                        PDO::FETCH_BOTH
                                    );
                                    $buchIdArray = [];
                                    $counter = -1;
                                    foreach ($queryTable as $items) {

                                        $buchId = $items['2'];
                                        array_push($buchIdArray, $buchId);
                                    ?>
                                        <tr>
                                            <!-- 0-> benutzerNahme -->
                                            <td scope="row"> <?php echo $items['2']; ?> </td>
                                            <td scope="row"> <?php echo $items['3']; ?> </td>
                                            <td scope="row"> <?php echo $items['4']; ?> </td>
                                            <td scope="row"> <?php echo $items['5']; ?> </td>
                                            <td scope="row"> <?php echo $items['6']; ?> </td>
                                            <td scope="row"> <?php echo $items['7']; ?> </td>
                                            <td scope="row">
                                                <form method="post">
                                                    <input type="submit" name="buchwahl" id="<?= $countId += 1 ?>" class="button" value="Ausleihe" />
                                                    <input type="label" name="arrayKey" class="button d-none" value="<?= $counter += 1 ?>" />
                                                    <input type="label" name="signature" class="button d-none" value="<?= $buchId ?>" />
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    print_r($buchIdArray);
                                    ?>
                                    <!-- Adina odunc kitap alinacak personelin kullanici adinin girilmesi -->

                                    <main class="form-control container">
                                        <div clas=" log-sm-6 ">
                                            <form method="post" action="
                                            <?php
                                            // echo htmlspecialchars( 'result.php'); 
                                            ?>
                                            ">
                                                <img class="rounded mx-auto d-block mb-4" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                                                <h4 class="text-primary">Buchausleihsystem Bibliothek-Modus</h4>
                                                <h1 class="h5 mb-3 fw-normal">Bitte geben Sie den Benutzernamen des Mitarbeiters ein, den Sie buchen möchten.</h1>
                                                <div class="h5 mb-5 fw-normal">

                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" />
                                                        <label for="floatingInput">Benutzernahme</label>
                                                    </div>

                                                    <button class="w-25 btn btn-lg btn-primary mt-2" type="submit">Einreichen</button>
                                            </form>
                                        </div>
                                    </main>
                        </div>

                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </section>
    <?php
    $usernameGuest;
    $bookSignature;
    if (array_key_exists('username', $_POST)) {
        echo $usernameGuest = $_POST['username'];

        ausleihe();
    }
    if (array_key_exists('signature', $_POST)) {
        echo $bookSignature = $_POST['signature'];
        ausleihe();
    }

    function ausleihe()
    {
        print_r($_POST);
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once 'themes/footer.php'; ?>