<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$accessClasses = new Access();

session_destroy();

$accessClasses->redirect('index.php');
?>