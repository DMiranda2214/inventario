<?php
    session_start();
    $GLOBALS['PAGE'] = '';
// Cargar el autoload de Composer 
    require_once '../vendor/autoload.php';
    require_once '../Config.php';
    require_once '../app/utils/Alert.php';
    require_once 'Database.php';
    require_once 'Controller.php';
    require_once 'View.php';
    require_once 'App.php';
?>