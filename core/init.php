<?php

// session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'bibliothek'
    ],

    'session' => [
        // kullanilmadi
        'session_name' => 'user'
    ],
];
/* lädt die Klassen automatisch. */
spl_autoload_register(function ($class) {
    // require_once 'classes/' . $class . '.class.php';      // ruft die Klassen im Ordner classes auf.
    // $path=__DIR__."/".$class.".class.php";
    $path = 'classes/' . $class . '.class.php';
    if (file_exists($path)) {
        require_once $path;
    }
});


// require_once 'IHK_PRJ/delete/borrowLibRediCont.php';
// require_once (__DIR__.'/delete/borrowLibRediCont.php');
// require_once ('/functions/borrowLibRediCont.php');
require_once 'borrowLibRediCont.php';



/* 
spl_autoload_register(function ($className) {
    $prefix = 'IHK_PRJ\\';
    $base_dir = __DIR__ . '/';
    $length = strlen($prefix);
    if (strncmp($prefix, $className, $length) !== 0) {
        return;
    }
    // $className=strtolower($className);
    $relative_class = substr($className, $length);
    $path = $base_dir . str_replace('\\', '/', $relative_class) . '.class.php';
    if (file_exists($path)) {
        require_once $path;
    }
});
 */
?>
