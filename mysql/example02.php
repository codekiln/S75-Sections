<?php
require('handy.php');
$purpose = "inser contact info for John "
  . "based off of "
  . "<a href='http://www.freewebmasterhelp.com/tutorials/phpmysql/2'>"
  . "this tutorial</a>'";
$exampleParams ='';
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).php/", 
  "\\1", $fname );
?>
<html>
  <head>
    <title><?=$fname?></title>
  </head>
  <body>
<h1><?= $fname ?></h1>
	<? printGet(); ?>
	Example parameters: 
<a href="<?=$fname.$exampleParams?>">
<?=$exampleParams?></a>
<p><?=$purpose?></p>
<div id="example"><?php 
/** your example code goes inside this div **/ ?> 
<pre>
<?
$user="jharvard";
$password="crimson";
$database="jharvard_example2";
mysql_connect(localhost,$user,$password);
mysql_select_db($database) or die( "Unable to select database");
/** THIS IS NEW **/
$query = "INSERT INTO contacts VALUES (null,'John','Harvard','01234 567890','00112 334455','01234 567891','jharvard@harvard.edu','http://www.cs75.net')";
mysql_query($query);
mysql_close();
?>
</pre>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
