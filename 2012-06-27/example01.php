<?php
session_start();
$purpose = 'Demonstrate the $_SESSION superglobal.';
/**
  * If your example requires some parameters, put 
  * a set of example parameters in here for the link
  * that appears at the top of the page
  */
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
    <?php if(strlen($exampleParams)>0) { ?>
	Example parameters: 
<a href="<?=$fname.$exampleParams?>">
<?=$exampleParams?></a>
    <?php } ?>
<p><?=$purpose?></p>
<div id="example">
<?php 
$_SESSION["first_name"] = 'Peter';
$_SESSION["last_name"] = 'Nore';
?> 
<h1>these session variables were set at the top of the page in PHP:</h1>
<table>
<tr><th>variable name</th><th>variable value</th></tr>
<tr><td>$_SESSION["first_name"]</td><td><?php echo $_SESSION["first_name"]; ?></td></tr>
<tr><td>$_SESSION["last_name"]</td><td><?php echo $_SESSION["last_name"]; ?></td></tr>
</table>
<a href="example02.php">click here to go to gexample02.php to see if the variables still exist</a>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
