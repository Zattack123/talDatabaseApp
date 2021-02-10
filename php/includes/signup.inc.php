<?php
//FILE: signup.inc.php
//Zach Dilliha, WKU 2020
//CS 351

if(isset($_POST['signup-submit'])){

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

//this begins a series of error checks, which will run everytime the signup process occurs, to check the various parameters to make sure theyre valid

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
    header("Location: ../signup.php?error=invalidmailuid");
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  else if($password !== $passwordRepeat){
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  //these check the signup input against information in the database, to check for unnique usernames, and they have if/else stmts to make sure the sql will work
  else {
    $sql = "SELECT uid FROM users WHERE uid=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck>0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uid, pwd, email) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
      }
      //this is the accepted signup step, where we encrypt the password so as to not have it be visible from the phpmyadmin database view
      else{
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
        mysqli_stmt_execute($stmt);
        header("Location: ../home.php?signup=success");
        exit();
      }
    }
  }
}
mysqli_stmt_close($stmt);
mysqli_close($conn);



}

else{
  header("Location: ../signup.php");
  exit();
}
