<!-- Kitap Odunc Alma Bibliothek-Modus -->
<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
echo $_SESSION['usernameGuest'] = $_POST['usernameGuest'];
?>
<!-- Sayfa listesi -->
<div class=" container-fluid">
    <div class="row ">
        <div class=" col-md-8 offset-md-2 ">
            <div class="card  mt-3 bg-light">
                <div class="card-body ">
                    <img class="mb-4 rounded mx-auto d-block" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                    <h3 class="text-primary text-center mb-5">Buchausleihsystem Bibliothek-Modus</h3>
                    <h5 class="text-primary text-center mb-5"> Modul für die Auflistung, Rückgabe und Verlängerung von Büchern</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Kitap listesi -->
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col ">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Signatur</th>
                                <th scope="col">Buchtitle</th>
                                <th scope="col">Autorenname</th>
                                <th scope="col">Autorennahcname</th>
                                <th scope="col">Bibliothekname</th>
                                <th scope="col">Buchstandort</th>
                                <th scope="col">Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $username = $_SESSION['username'];
                            $db = DB::getInstance();
                            $sql = "SELECT benutzerName, buchID, signatur, buchTitel, autorVorname, autorNachname, bibliothekName, standortBezeichnung
                                            FROM buecher bu
                                            INNER JOIN bibliotheken bi USING(bibliothekID)
                                            INNER JOIN standorte st USING(bibliothekID)
                                            INNER JOIN ausleihe au USING (buchID)
                                            INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
                                            INNER JOIN buchStatus bus USING (buchStatusID)
                                            WHERE buchStatusID=2;";
                            $queryTable = $db->tableOperations($sql, PDO::FETCH_BOTH);
                            // $buchIdArray = [];
                            // $counter = -1;
                            foreach ($queryTable as $items) {
                                $buchID = $items['1'];
                                // array_push($buchIdArray, $signature);
                            ?>
                                <!-- 0-> benutzerNahme  1-> buchID -->
                                <td scope="row"> <?php echo $items['2']; ?> </td>
                                <td scope="row"> <?php echo $items['3']; ?> </td>
                                <td scope="row"> <?php echo $items['4']; ?> </td>
                                <td scope="row"> <?php echo $items['5']; ?> </td>
                                <td scope="row"> <?php echo $items['6']; ?> </td>
                                <td scope="row"> <?php echo $items['7']; ?> </td>
                                <td scope="row">
                                    <form method="post" action="borrowLibRecords.php">
                                        <input type="label" name="buchID" class="form-control button d-none" id="" value="<?= $buchID ?>">
                                        <input type="submit" name="buchwahl" class="form-control button d-non" id="" value="Ausleihe">
                                    </form>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'themes/footer.php'; ?>