<?php
//FILE: index.php
//Zach Dilliha, WKU 2020
//CS 351
require "header.php"
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <?php
      //there is no way to get to this page normally, but if the user manually goes to this page, they will only see the header along with this message
      if (isset($_SESSION['userUid'])) {
        echo '<p class="login-status">You are logged in!</p>';
      }
      //if session variables are not set, nobody is logged in, or they just logged out, so it displays this messsage 
      else{
        echo '<p class="login-status">You are logged out!</p>';
      }
       ?>
    </section>
  </div>
</main>



<?php
require "footer.php"
?>
