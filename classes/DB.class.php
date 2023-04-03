<?php 

class DB {

    private static $PDO_obj = null;   // Singleton instance of DB Class 
    public $_pdo,              // SQL connection cursor object
            $_query,            // last query
            $_results,          // results returned from query
            $_count = 0,        // number of results returned
            $_error = false;

// Constructor function; Creates PDO object and insert into DB Singleton Object.
    private function __construct() {
        try {
            $host_DB='mysql:host='.Config::get('mysql/host').
                    ';dbname='.Config::get('mysql/db');

            $this->_pdo = new PDO($host_DB,
                                Config::get('mysql/username'), 
                                Config::get('mysql/password'));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, // Hatalari ekrana yazar.
                                PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  // Varsayilan Fetch modunu objekt olarak ayarlar.
                                    PDO::FETCH_OBJ); 
            echo "connected<br>";
        } catch(PDOException $e) {
            die("Auf die Datenbank konnte nicht mit PDO zugegriffen werden.<br>"
                .$e->getMessage());
        }
    }
// Create DB instance using Singleton Pattern
    public static function getInstance() {
        if(!isset(self::$PDO_obj)) {
            self::$PDO_obj = new DB();
        }
        return self::$PDO_obj;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)) {
            // echo " Success";
            // echo "<br>".$sql."<br>";
            // print_r($params);
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    // echo $param;
                    $this->_query->bindValue($x, $param); // Degerleri key-value olarak bir dizide birlestirir.
                    $x++;
                    // echo $x."<br>";
                }
            }
            if($this->_query->execute()) {
                // echo "Success";
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }   

    public function tableOperations($qeury, $myFetchMode){
        // exec
        $myDB = $this->_pdo->query($qeury, $myFetchMode);
        $myDB =$myDB->_results;
        return $myDB;
    }
    public function maintanance($qeury){
        $myTable = $this->_pdo->query($qeury);
        $myTable->setFetchMode(PDO::FETCH_NUM);
        return $myTable;
    }

   
   
// Veritabani baglantisini kapatir.
    public function __destruction() {
        
        $this->_pdo = NULL;
    }
}


    // print_r(PDO::getAvailableDrivers());    // PDO ile MySQL kullanilabilir mi?
?>