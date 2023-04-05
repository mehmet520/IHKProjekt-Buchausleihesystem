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
                                        <th scope="col">Benutzername</th>
                                        <th scope="col">Institut</th>
                                        <th scope="col">Fristdatum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $sql = "SELECT signatur, buchTitel, autorVorname, autorNachname, benutzerName, einrichtungBezeichnung , fristDatum
                                            FROM ausleihe au
                                            INNER JOIN buecher bu USING(buchID)
                                            INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
                                            INNER JOIN einrichtungen ei USING(einrichtungID);";
                                    $queryTable = $db->tableOperations($sql, PDO::FETCH_BOTH);
                                    print_r($queryTable);
                                    foreach ($queryTable as $items) {
                                    ?>
                                        <tr>
                                            <!-- 5-> benutzerNahme -->
                                            <td scope="row"> <?php echo $items["0"]; ?> </td>
                                            <td scope="row"> <?php echo $items["1"]; ?> </td>
                                            <td scope="row"> <?php echo $items["2"]; ?> </td>
                                            <td scope="row"> <?php echo $items["3"]; ?> </td>
                                            <td scope="row"> <?php echo $items["4"]; ?> </td>
                                            <td scope="row"> <?php echo $items["5"]; ?> </td>
                                            <td scope="row"> <?php echo $items["6"]; ?> </td>
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