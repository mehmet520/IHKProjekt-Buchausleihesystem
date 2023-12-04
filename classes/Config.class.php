<?php

class Config {
    public static function get($path = null) {  // liefert $GLOBALS-Konfigurationsdaten aus der Datei init.php
        if($path) {
            $config = $GLOBALS['config'];      // assign config data from config array 
            $path = explode('/', $path);  // save path as an array
            
            foreach($path as $value) {
                if(isset($config[$value])) {    // Überprüfen Sie den Wert des Schalters.
                    $config = $config[$value];  // Der Speicher des Arrays wird zum Schlüssel des Arrays. Schließlich wird er als Wert des Arrays zugewiesen. 
                }
            }
            
            return $config;             // return query result
        }
        
        return false;
    }   
}

?>