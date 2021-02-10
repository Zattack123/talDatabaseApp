<?php
//FILE: addRep.php
//Zach Dilliha, WKU 2020
//CS 351


//starting a session allows us to access "global" variables
session_start(); ?>

<!-- this starts the HTML document, which is added on to when each file is loaded -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>TAL Database App</title>


  </head>

  <body>
    <header>
      <h1>Tal Database</h1>
      <?php
      //if there is someone signed in, then display their name in the header
      if (isset($_SESSION['userUid'])) {
          echo "<p>Signed in as " . $_SESSION['userUid'] ."</p>";
        }

       ?>
      <nav>
        <p>
            <?php
            //if there is someone logged in, then the home button sends them to home.php, the home menu page
              if (isset($_SESSION['userUid'])) {
                echo '<a  href="home.php">Home</a></li>';
              }
              //if nobody is logged in, the home button sends them to index.php, the login/signup page
              else{
                echo '<a  href="index.php">Home</a></li>';
              }
             ?>
        </p>
        <div class= "header-login">
          <?php
          //if someone is logged in, there will be a "logout" button
          if (isset($_SESSION['userUid'])) {
            echo '<form action ="includes/logout.inc.php" method = "post">
              <button type="submit" name="logout-submit">Logout</button>
            </form>';
          }
          //if nobody is logged in, there will be a login form and a signup button
          else{
            echo '<form action ="includes/login.inc.php" method = "post">
              <input type="text" name="mailuid" placeholder="Username">
              <input type="password" name="pwd" placeholder="Password">
              <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>';
          }
           ?>

        </div>
      </nav>
    </header>
  </body>
</html>
