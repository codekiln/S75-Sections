<?php


function get_mysql()
{
  //Connect to the APP DB using helper function 
  /*** mysql hostname ***/ $hostname = 'localhost';
  /*** mysql username ***/ $username = 'jharvard';
  /*** mysql password ***/ $password = 'crimson';
  try {  
    global $dbh;
    $dbh = new PDO("mysql:host=$hostname;dbname=jharvard_cs75finance", $username, $password);
  } catch(PDOException $e)     {     echo $e->getMessage();     }
}
 
