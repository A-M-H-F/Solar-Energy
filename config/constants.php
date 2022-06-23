<?php 
    //Start Session
    session_start();


    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/wattco/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'amhf');
    define('DB_PASSWORD', '');
    define('DB_NAME', '');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die('Error: Check Database Connection' .mysqli_error($myConnection)); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die('Error: Check Database Connection' .mysqli_error($myConnection)); //SElecting Database


?>