<?php
require('handy.php');
$purpose = "A simple statement about example purpose"
 . " appears at the top of the page";
/**
  * If your example requires some parameters, put 
  * a set of example parameters in here for the link
  * that appears at the top of the page
  */
$exampleParams ='?foo=bar&baz=bat';
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
	<p>Your great example code goes here</p>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
