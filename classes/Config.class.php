<?php

class Config {
    public static function get($path = null) {  // returns $GLOBALS configuration data from init.php file
        if($path) {
            $config = $GLOBALS['config'];      // assign config data from config array 
            $path = explode('/', $path);  // save path as an array
            
            foreach($path as $value) {
                if(isset($config[$value])) {    // Anahterin degeri kontrol edilir.
                    $config = $config[$value];  // Dizinin deperi, dizinin anahtari olur. En sonda dizinin degeri olarak atanir. 
                }
            }
            
            return $config;             // return query result
        }
        
        return false;
    }   
}

?>