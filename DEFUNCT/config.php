<?php
//FILE: config.php
//Zach Dilliha, WKU 2020
//CS 351

//sets variables to be used in installation and database connection
$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "tal";
$conn = mysqli_connect($host, $username, $password);
echo 'heck';
