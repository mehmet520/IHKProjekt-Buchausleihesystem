<?php
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
                                        <th scope="col">einrichtungID</th>
                                        <th scope="col">kostenstelleNummer</th>
                                        <th scope="col">einrichtungBeschreibung</th>
                                        <th scope="col">einrichtungBezeichnung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $myQuery = $db->tableOperations(
                                        "SELECT * FROM einrichtungen WHERE einrichtungID BETWEEN 2 AND 15",
                                        PDO::FETCH_BOTH
                                    );
                                    foreach ($myQuery as $items) {
                                        echo $items['einrichtungID'];
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $items["einrichtungID"]; ?> </th>
                                            <td><?php echo $items["kostenstelleNummer"]; ?></td>
                                            <td><?php echo $items["einrichtungBeschreibung"]; ?></td>
                                            <td><?php echo $items["einrichtungBezeichnung"]; ?></td>
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