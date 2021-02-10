<?php
//FILE: orderReport.php
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

//if the submit button was pressed, do the following
if (isset($_POST['submit'])) {

//this grabs the customer name from the form, to be used as a variable
  $custName = $_POST['CustomerName'];

//this sql generates a report that displays the total quoted price of all orders placed by a given customer
//there is a placeholder '?' so we can test the sql before handling any data
  $sql = "SELECT customer.CustomerName, SUM(orderline.QuotedPrice * orderline.NumOrdered) as TotalQuotedPrice
      FROM customer, orderline, orders
      WHERE customer.CustomerName = ? AND customer.CustomerNum = orders.CustomerNum AND orders.OrderNum = orderline.orderNum";

  $stmt = mysqli_stmt_init($conn);
  //if the sql does not work, go back to the home page with an error
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location:home.php?error=sqlerror");
    exit();
  }
  //if it works, bind the values to the $stmt and execute the query
  else{
    mysqli_stmt_bind_param($stmt, "s", $custName);
    mysqli_stmt_execute($stmt);
    //this grabs the results of the query to be used in the display method
    $result = mysqli_stmt_get_result($stmt);
  }
}
 ?>

<?php
//if the submit button was pressed and $stmt is valid, display the information from the query
if(isset($_POST['submit']) && $stmt) {
      $row = mysqli_fetch_array($result);
      echo "<p>Order Report for: " . $custName . "</p>";
      if ($row['TotalQuotedPrice']) {
          echo "<p>The Total Quoted Price of all orders placed by " . $custName . " is $" . $row['TotalQuotedPrice'] . "</p>";
      }
      else {
        echo "<p>" . $custName . " does not currently have any orders</p>";
      }
  } ?>

<!--This begins the form where the user inputs the customer name for the report -->
    <h2>View a Customer's Order Report</h2>

    <form method= "post">
        <label for="CustomerName">Customer Name: </label>
        <input type="text" name="CustomerName" id="CustomerName">

        <input type="submit" name="submit" value="Submit">
      </form>

      <?php require "footer.php" ?>
