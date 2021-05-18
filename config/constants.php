<?php
// start session
session_start();


// Create constants to store Non Repeating Values
define('HOME_URL','http://localhost/projects/food/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('LDB_PASSWORD','');
define('DB_NAME','food');

$conn = mysqli_connect("localhost","root","") or die(mysqli_error($conn)); //db connection
    
mysqli_select_db($conn,"food") or die(mysqli_error($conn)); //selecting db


?>

