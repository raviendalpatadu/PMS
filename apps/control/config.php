<?php
//DATABASE CONFIGURATION
session_start();

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'db_pms');
define('DB_USER', 'root');
define('DB_PASS', '');

//DATABASE CONNEVTION-STRING

    $conn = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME,DB_USER,DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //to display error msg
    
//    SITE CONFIGURATION
    
define('BASE_URL', 'http://localhost/PMS/ELECTRON-4-PHP/');
define('LOCAL_PATH', 'C:/\xampp/\htdocs/\PMS/\ELECTRON-4-PHP\/');
define('SITE_TITLE', 'PHARMACY MANAGEMENT SYSTEM');


require_once 'template.php';

?>
