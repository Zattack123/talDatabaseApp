<?php
//FILE: logout.inc.php
//Zach Dilliha, WKU 2020
//CS 351
//this file is called when the logout button is pressed, which clears the session of any variables and sends the user back to the login page

session_start();
session_unset();
session_destroy();

header("Location: ../index.php");
