<?php
// start session
session_start();

//create constant for non repeating values
define('SITEURL','http://localhost/p/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','login');


$conn= mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);//database connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$db_select=mysqli_select_db($conn,DB_NAME);// select databse
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 









?>