<?php
require('handy.php');
$purpose = "create the table jharvard_example2"
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
$query="CREATE TABLE contacts (id int(6) NOT NULL auto_increment,first varchar(15) NOT NULL,last varchar(15) NOT NULL,phone varchar(20) NOT NULL,mobile varchar(20) NOT NULL,fax varchar(20) NOT NULL,email varchar(30) NOT NULL,web varchar(30) NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
mysql_query($query);
mysql_close();
?>
</pre>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
