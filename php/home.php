<?php
//FILE: home.php
//Zach Dilliha, WKU 2020
//CS 351
include "header.php"; ?>

<?php

//if ther eare session variables set, then display the proper home page
  if(isset($_SESSION['userUid'])){
  echo "<ul>";
    echo '<li><a href="addRep.php"><strong>Add Rep</strong></a> - Add a New Representative</li>';
    echo '<li><a href="updateCredit.php"><strong>Update</strong></a> - Update a Customers Credit Limit</li>';
    echo '<li><a href="repReport.php"><strong>Representative Report</strong><a> - View a Representatives Customers and Average Balance</li>';
    echo '<li><a href="orderReport.php"><strong>Order Report</strong><a> - View the Total Quoted Price of a Customers Orders</li>';
  echo "</ul>";
}
//if session variables have not been set, it means nobody is logged in, so send them back to the login page
else{
  header("Location:index.php");
  exit();
}
  ?>

<?php include "footer.php"; ?>
