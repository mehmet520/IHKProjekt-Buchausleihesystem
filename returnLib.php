<!-- Auflistung, Rückgabe und Verlängerung von Büchern Bibliothek-Modus -->
<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';
?>
<!-- Titel der Seite -->
<div class=" container-fluid">
    <div class="row ">
        <div class=" col-md-8 offset-md-2 ">
            <div class="card  mt-3 bg-light">
                <div class="card-body ">
                    <img class="mb-4 rounded mx-auto d-block" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
                    <h3 class="text-primary text-center mb-5">Buchausleihsystem Bibliothek-Modus</h3>
                    <h5 class="text-primary text-center mb-5">Auflistung, Rückgabe und Verlängerung von Büchern</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Bücherliste -->
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col ">
                <div class="table-responsive ">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Benutzername</th>
                                <th scope="col">Signatur</th>
                                <th scope="col">Buchtitle</th>
                                <th scope="col">Autorenname</th>
                                <th scope="col">Autorennahcname</th>
                                <th scope="col">Institut</th>
                                <th scope="col">Fristdatum</th>
                                <th scope="col">Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $username = $_SESSION['username'];
                            $db = DB::getInstance();
                            // Library ID of Book
                            $sqlBuchBibl = "SELECT  bibliothekID
                                            FROM  buecher bu                                             
                                            INNER JOIN standorte st USING(standortID)
                                            INNER JOIN bibliotheken bi USING(bibliothekID)
                                            WHERE buchID=?;";
                            // Buchliste
                            $sql =
                            "SELECT benutzerName, buchID, signatur, buchTitel, autorVorname, autorNachname, einrichtungBezeichnung, rueckgabeDatum
                                            FROM ausleihe au
                                            INNER JOIN buecher bu USING (buchID)
                                            INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
                                            INNER JOIN einrichtungen ei USING(einrichtungID)
                                            WHERE buchStatusID=? AND ausleiheStatusID !='5' AND ausleiheStatusID !='4' ;";     // buchStatus-> 1:'vorhanden', 2:'ausgelieht', 3:'vermisst', 4:'gloescht'
                            $queryTable = $db->getRows($sql, [2]);
                            foreach ($queryTable as $items) {
                                $buchID = $items['1'];
                                $queryTable1 = $db->getRow($sqlBuchBibl, [$buchID]);
                                $bookLib = $queryTable1['bibliothekID'];
                            ?>
                                <!-- 0-> benutzerNahme  1-> buchID -->
                                <td scope="row"> <?php echo $items['0']; ?> </td>
                                <td scope="row"> <?php echo $items['2']; ?> </td>
                                <td scope="row"> <?php echo $items['3']; ?> </td>
                                <td scope="row"> <?php echo $items['4']; ?> </td>
                                <td scope="row"> <?php echo $items['5']; ?> </td>
                                <td scope="row"> <?php echo $items['6']; ?> </td>
                                <td scope="row"> <?php echo $items['7']; ?> </td>
                                <td scope="row">
                                    <form method="post" action="entryGuestUnameRetLib.php">
                                        <input type="label" name="buchID" class="form-control button d-none " id="" value="<?= $buchID ?>">
                                        <?php if ($bookLib == $_SESSION['library']) {
                                            echo '<input type="submit" name="selection" class="form-control button d-non " id="" value="Return">';
                                            echo '<input type="submit" name="selection" class="form-control button d-non" id="" value="Extend">';
                                        }
                                        ?>
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