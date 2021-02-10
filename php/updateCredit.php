<?php
//FILE: updateCredit.php
//Zach Dilliha, WKU 2020
//CS 351

//the files we need to include for this file
require "includes/dbh.inc.php";
require "header.php";

//if this page is loaded and there is nobody signed in, redirect them to the login page
if(!$_SESSION['userUid']){
    header("Location:index.php");
    exit();
}

//if the submit button was pressed, do the following
  if (isset($_POST['submit'])) {


//grabs the input from the form as variables
    $custName = $_POST['CustomerName'];
    $newLimit = $_POST['NewLimit'];

//this sql updates the credit limit of a given customer, using placeholders (?) for the inputs so we can test the query before handling data
    $sql = "UPDATE customer SET CreditLimit = ? WHERE CustomerName = ?";
    $stmt = mysqli_stmt_init($conn);

//if the sql does not work, go back to the home page with an error
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location:home.php?error=sqlerror");
      exit();
    }
//the sql works, so bind the variables to their respective placeholders and execute the query
    else {
      mysqli_stmt_bind_param($stmt, "ds", $newLimit, $custName);
      mysqli_stmt_execute($stmt);
    }
}

?>

<?php
//if the submit button was pressed and $stmt is valid, that means the query was successful, so tell the user that the customer was updated
    if (isset($_POST['submit']) && $stmt) { ?>
        <blockquote><?php echo $_POST['CustomerName']; ?>'s credit limit successfully updated!</blockquote>
<?php } ?>


<!--This is the form the user sees and inputs information to -->
<h2>Update A Customers Credit Limit</h2>

<form method="post">
  <p>
    <label for="CustomerName">Customer Name: </label>
    <input type="text" name="CustomerName" id="CustomerName">
</p>
<p>
    <label for="NewLimit">New Credit Limit: </label>
    <input type="number" name="NewLimit" id="NewLimit">
  </p>
  <p>
    <input type="submit" name="submit" value="Submit">
  </p>
  </form>


<?php require "footer.php" ?>
