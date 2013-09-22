<?php

require ('helpers.php');
get_mysql();
 
$username_to_test = ':username';

  /*** prepare the SQL SELECT statement ***/
  // http://goo.gl/uPWYV
  $stmt = $dbh->prepare("SELECT username, password FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username_to_test, PDO::PARAM_STR, 64);
  $stmt->execute();
  $red = $stmt->fetchAll();
  echo '<pre>';
  echo print_r($red);
  echo '</pre>';
