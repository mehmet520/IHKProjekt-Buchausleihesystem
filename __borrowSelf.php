<?php
require_once 'themes/aheader.php';
require_once 'core/init.php';
?>

<body>
    <h1>Hello,</h1>
    <div class=" container-fluid">
        <div class="row ">
            <div class=" col">
                <div class="card mt-3 bg-light">
                    <div class="card-body ">
                        <?php
                        // guery, fetch, fetchAll, fetchColumn 
                        //Array - FETCH ASSOC, 
                        //Array - FETCH NUM, 
                        //Array -FETCH BOTH, 
                        //Object- FETCH OBJ
                        $db = DB::getInstance();
                        ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT signatur, buchTitel AS Buchtitle, autorVorname, autorNachname, bibliothekName, standortBezeichnung
                                            FROM buecher bu
                                            INNER JOIN bibliotheken bi USING(bibliothekID)
                                            INNER JOIN standorte st USING(bibliothekID)
                                            INNER JOIN ausleihe au USING (buchID)
                                            INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
                                            WHERE benutzerName='3_benutzerName';";
                                    $queryTable = $db->tableOperations($sql, PDO::FETCH_BOTH);
                                    print_r($queryTable);
                                    foreach ($queryTable as $items) {
                                    ?>
                                        <tr>
                                            <th scope="row"> <?php echo $items["0"]; ?> </th>
                                            <td scope="row"> <?php echo $items["1"]; ?> </td>
                                            <td scope="row"> <?php echo $items["2"]; ?> </td>
                                            <td scope="row"> <?php echo $items["3"]; ?> </td>
                                            <td scope="row"> <?php echo $items["4"]; ?> </td>
                                            <td scope="row"> <?php echo $items["5"]; ?> </td>
                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <?php require_once "themes/footer.php"; ?>