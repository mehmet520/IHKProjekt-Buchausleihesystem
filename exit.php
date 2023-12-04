<?php
session_start();
require_once 'themes/aheader.php';
require_once 'core/init.php';

session_unset();
session_destroy();
Redirect::goTo('signin.php');

?>