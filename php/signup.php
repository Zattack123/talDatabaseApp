<?php
//FILE: signup.php
//Zach Dilliha, WKU 2020
//CS 351

//this file is what is shown to the user when either the signup process has failed in some way, displaying the corresponding error,
//or to send the user back to the login page if the signup was successful
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h1>Signup</h1>
      <p>
        <a href="home.php"><strong>Home</strong></a>
      </p>
      <?php
      //these conditions check for various errors sent back from signup.inc.php, and displays to the user what happened
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<p class="signuperror">Fill in all fields!</p>';
          }
          else if ($_GET['error'] == "invalidmailuid") {
            echo '<p class="signuperror">Invalid Username & Email!</p>';
          }
          else if ($_GET['error'] == "invaliduid") {
            echo '<p class="signuperror">Invalid Username!</p>';
          }
          else if ($_GET['error'] == "invalidmail") {
            echo '<p class="signuperror">Invalid Username & Email!</p>';
          }
          else if ($_GET['error'] == "passwordcheck") {
            echo '<p class="signuperror">Your Passwords do not match!</p>';
          }
          else if ($_GET['error'] == "usertaken") {
            echo '<p class="signuperror">Username already taken!</p>';
          }
        }
      
      ?>
      <!-- This is the signup form, it grabs the input and sends it to signup.inc.php to be processed-->
      <form class="form-signup" action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username">
        <input type="text" name="mail" placeholder="e-mail">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd-repeat" placeholder="Re-Type Password">
        <button type="submit" name="signup-submit">Sign Up</button>

      </form>
    </section>
  </div>
</main>

<?php
require "footer.php"
?>
