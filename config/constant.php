<?php
//start session
session_start();
//create constants to store non repeating value
define('SITEURL','http://localhost/food_order/');
 define('LOCALHOST', 'localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD','');
 define('DB_NAME', 'food-order');

 //execute query and save data in database
 $con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die (mysqli_error()); //database connection
 $db_select = mysqli_select_db($con, DB_NAME) or die (mysqli_error()); // selecting database

?>