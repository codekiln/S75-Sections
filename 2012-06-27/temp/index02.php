<?php
session_start();
$password="trustno1";
?>
<html>
  <head>
  <title>temporary page</title>
  </head>
  <body>
  <h1>temporary page is working</h1><br />
  <?php 
  if(@$_POST['password']==$password){
    echo "YOU GOT IN!";
    echo $_POST['first_name'];
    echo "<br/>";
    echo $_POST['password'];
    } else {
        echo "You did not enter the right password.";
    }
    ?>
  </body>
  </html>
