<?php
//FILE: addRep.php
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
//if the 'submit' button was pressed, then continue with the operation
  if (isset($_POST['submit'])) {

//these grab the values from the form
          $repNum = $_POST['RepNum'];
          $lastName = $_POST['LastName'];
          $firstName = $_POST['FirstName'];
          $street = $_POST['Street'];
          $city = $_POST['City'];
          $state = $_POST['State'];
          $postal = $_POST['PostalCode'];
          $commiss = $_POST['Commission'];
          $rate = $_POST['Rate'];

      //this sql query inserts the values into the rep table, using the placeholder '?' so we can check the connection before we handle any data
      $sql = "INSERT INTO Rep (RepNum, LastName, FirstName, Street, City, State, PostalCode, Commission, Rate) VALUES(?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    //this checks the validity of the sql query, if it doesn't work, it sends them back home with an sqlerror
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location:home.php?error=sqlerror");
      exit();
    }
    //no error, so it binds values to the placeholders in $stmt, and then actually performs the query
    else {
      mysqli_stmt_bind_param($stmt, "sssssssss", $repNum, $lastName, $firstName,
      $street, $city, $state, $postal, $commiss, $rate);
      mysqli_stmt_execute($stmt);
    }
}
?>

<?php
//if the submit button was pressed and $stmt is valid, the query was processed and it displays the validation message
if (isset($_POST['submit']) && $stmt) { ?>
    <blockquote><?php echo $_POST['FirstName']; ?> successfully added.</blockquote>
<?php } ?>

<!--This starts the html for the form, where the user inputs the reps information -->
<h2>Add a Representative</h2>

<form method="post">
<p>
    <label for="RepNum">Rep Number: </label>
    <input type="text" name="RepNum" id="RepNum">
</p>
<p>
    <label for="FirstName">First Name: </label>
    <input type="text" name="FirstName" id="FirstName">
</p>
<p>
    <label for="LastName">Last Name: </label>
    <input type="text" name="LastName" id="LastName">
</p>
<p>
    <label for="Street">Address: </label>
    <input type="text" name="Street" id="Street">
</p>
<p>
    <label for="City">City: </label>
    <input type="text" name="City" id="City">
</p>
<p>
    <label for="State">State: </label>
    <input type="text" name="State" id="State">
</p>
<p>
    <label for="PostalCode">Postal Code: </label>
    <input type="text" name="PostalCode" id="PostalCode">
</p>
<p>
    <label for="Commission">Commission: </label>
    <input type="text" name="Commission" id="Commission">
</p>
<p>
    <label for="Rate">Rate: </label>
    <input type="text" name="Rate" id="Rate">
</p>
<p>
    <input type="submit" name="submit" value="Submit">
</p>
</form>

<?php require "footer.php"; ?>
