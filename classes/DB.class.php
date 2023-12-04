<?php 
class DB {
    private static $PDO_obj = null;   // Singleton instance of DB Class 
    public $_pdo,                    // SQL connection cursor object
            $_query,                // last query
            $_results,               // results returned from query
            $_count = 0,            // number of results returned
            $usernameGuest,
            $username,
            $_error = false;
// Constructor function; Creates PDO object and insert into DB Singleton Object.
    private function __construct() {
        try {
            $host_DB='mysql:host='.Config::get('mysql/host').
                    ';dbname='.Config::get('mysql/db');

            $this->_pdo = new PDO($host_DB,
                                Config::get('mysql/username'), 
                                Config::get('mysql/password'));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE,            // Schreibt Fehler auf den Bildschirm.
                                PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  // Setzt den Standard-Fetch-Modus auf Objekt.
                                    PDO::FETCH_BOTH); 
            // echo "connected<br>";
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
    public function tableOperations($qeury, $myFetchMode){
        // exec
        $this->_query = $this->_pdo->query($qeury, $myFetchMode);
        return $this->_query;
    }
    private function myQuery($query, $params = null)
    {
        //die Methode, mit der sich wiederholende Daten in anderen Methoden beendet werden
        if (is_null($params)) {
            $this->_query = $this->_pdo->query($query);
        } else {
            $this->_query = $this->_pdo->prepare($query);
            $this->_query->execute($params);
        }
        return $this->_query;
    }
    public function getRows($query, $params = null)
    {
        //zum Abrufen mehrzeiliger Daten
        try {
            return $this->myQuery($query, $params)->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function getRow($query, $params = null)
    {
        //um eine einzelne Datenzeile zu ziehen
        try {
            return $this->myQuery($query, $params)->fetch();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function getColumn($query, $params = null)
    {
        //Punktdatenabruf zum Abruf von Spaltendaten einer einzelnen Zeile
        try {
            return $this->myQuery($query, $params)->fetchColumn();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function insert($query, $params = null)
    {
        //um einen Datensatz hinzuzufügen
        try {
            $this->myQuery($query, $params);
            return $this->_pdo->lastInsertId();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function update($query, $params = null)
    {
        //zur Aktualisierung des Registers
        try {
            return $this->myQuery($query, $params)->rowCount();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

// Schaltet die Datenbankverbindung aus.
    public function __destruction() {
        
        $this->_pdo = NULL;
    }
}
?>