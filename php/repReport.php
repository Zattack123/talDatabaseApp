<?php
//FILE: repReport.php
//Zach Dilliha, WKU 2020
//CS 351

//the files we need to include for this file
require "includes/dbh.inc.php";
require "header.php";

//if this page is loaded and there is nobody signed in, redirect them to the login page
if(!isset($_SESSION['userUid'])){
    header("Location:index.php");
    exit();
}

//this sql gets the information desired from the rep and customer table, and calculates the number of customers each rep has as well as the average balance of their customers
//this sql does not need placeholders because there is no input required
  $sql = "SELECT rep.RepNum, LastName, FirstName, COUNT(*) as NumCustomers, AVG(Balance) as AverageBalance
              FROM customer, rep
              WHERE rep.RepNum = customer.RepNum
              GROUP BY RepNum
              ORDER BY RepNum";

    echo "<h2>Representative Report</h2>";
    //this line both checks if the query is valid, executes it, and stores the results in $result
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//this loops through $result row by row and displays the information for each rep
    while($row = mysqli_fetch_array($result)){
      echo "<p>";
      echo $row['FirstName'] . " " . $row['LastName'] . " has " .
      $row['NumCustomers'] . " customers, with an Average Balance of $" . $row['AverageBalance'];
      echo "</p>";
    }

?>


  <?php require "footer.php" ?>
