<?php
$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'bibliothek'
    ],
    'folderName' => '/Buchausleihesystem 230411',
];
/* lädt die Klassen automatisch. */
spl_autoload_register(function ($class) {
    $path = $_SERVER["DOCUMENT_ROOT"] . $GLOBALS['config']['folderName']. "//classes/" . $class . ".class.php";
    if (file_exists($path)) {
        require_once $path;
    }
});
?>
