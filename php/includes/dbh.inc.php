<?php
//FILE: dbh.inc.php
//Zach Dilliha, WKU 2020
//CS 351

//this is a seperate connection to the database, this time specifying the 'tal' database
//this file will be included in every file that requires a connection to the 'tal' database
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "tal";

$conn = mysqli_connect($servername, $username, $password, $dbName);


if (!$conn) {
  die("Connection Failed: ".mysqli_connect_error());
}
