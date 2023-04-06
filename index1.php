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
          <h3 class="lead ">
            <?php
            $sql = 'SELECT * FROM benutzer WHERE kontoPasswort = ? ';
            // $query = DB::getInstance()->query($sql, [$username]);
            $db = DB::getInstance();
            $getQuery = $db->tableOperations($sql, [$username]);
            if ($getQuery) {
              echo '<pre> Basarili</pre>';
              print_r($getQuery);
            }
            ?>
          </h3>

        </div>
      </div>
    </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php require_once "themes/footer.php"; ?>