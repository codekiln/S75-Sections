<?php
session_start();
$purpose = 'Demonstrate the $_SESSION superglobal, pt 2. Also, demonstrate
session_destroy().';
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
?> 
<h1>these session variables were NOT set at the top of this page:</h1>
<table>
<tr><th>variable name</th><th>variable value</th></tr>
<tr><td>$_SESSION["first_name"]</td><td><?php echo
$_SESSION["first_name"]; ?></td></tr>
<tr><td>$_SESSION["last_name"]</td><td><?php echo
$_SESSION["last_name"]; ?></td></tr>
</table>
<h1>As you can see, the session still exists 
and the variables still hold information.</h1>
<h1>At the end of this page, the session 
will be destroyed with session_destroy().</h1>
<h2>refresh example02 to watch the variable values
disappear</h2>
<h2>go back to example01 to set the session variables
again</h2>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
<?php session_destroy(); ?>
