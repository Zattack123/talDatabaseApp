<?php
//FILE: login.inc.php
//Zach Dilliha, WKU 2020
//CS 351

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

//if the user does not fill out a field in the login prompt, it will return tot he index with an error message in the url
  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
//this sql checks the inputted values against the records in the user table, using placeholders '?' for the inputs for security
    $sql = "SELECT * FROM users WHERE uid = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
//if the sql does not work, send the user back to the login screen with an error
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    
    else{
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwd']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
        //if the inputted username and password are valid, create a session and set the session variables to those of the user, then send them to the home page
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['admin'] = $row['isAdmin'];
          $_SESSION['userUid'] = $row['uid'];

          header("Location: ../home.php?login=success");
          exit();

        }
        else {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }

  }




}
else{
  header("Location: ../index.php");
  exit();
}
