<?php
require('handy.php');
$purpose = "output data from database "
  . " Based off of "
  . "<a href='http://www.freewebmasterhelp.com/tutorials/phpmysql/2'>"
  . "this tutorial</a>'";
$exampleParams ='';
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).php/", 
  "\\1", $fname );

/** THIS IS NEW **/
$user="jharvard";
$password="crimson";
$database="jharvard_example1";

if( count($_POST) > 0 ) {
	$first=$_POST['first'];
	$last=$_POST['last'];
	$phone=$_POST['phone'];
	$mobile=$_POST['mobile'];
	$fax=$_POST['fax'];
	$email=$_POST['email'];
	$web=$_POST['web'];

	mysql_connect(localhost,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$query = "INSERT INTO contacts VALUES ('','$first','$last','$phone','$mobile','$fax','$email','$web')";
	mysql_query($query);

	mysql_close();
}
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
<? echo ( $exampleParams ) ? $exampleParams 
	: "No parameters" ;?></a>
<p><?=$purpose?></p>
<div id="example"><?php 
/** your example code goes inside this div **/ ?> 
<!-- THIS IS NEW -->
<form action="<?=$fname?>" method="post">
  First Name: <input type="text" name="first"><br>
  Last Name: <input type="text" name="last"><br>
  Phone: <input type="text" name="phone"><br>
  Mobile: <input type="text" name="mobile"><br>
  Fax: <input type="text" name="fax"><br>
  E-mail: <input type="text" name="email"><br>
  Web: <input type="text" name="web"><br>
	<input type="Submit">
</form>
<?php 
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM contacts";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();

echo "<hr/><b><center>Database Output</center>"
.	"</b><br><br>";

$i=0;
while ($i < $num) {

$first=mysql_result($result,$i,"first");
$last=mysql_result($result,$i,"last");
$phone=mysql_result($result,$i,"phone");
$mobile=mysql_result($result,$i,"mobile");
$fax=mysql_result($result,$i,"fax");
$email=mysql_result($result,$i,"email");
$web=mysql_result($result,$i,"web");

echo "<b>$first $last</b><br/>"
.	"Phone: $phone<br>"
.	"Mobile: $mobile<br>"
.	"Fax: $fax<br>E-mail: $email<br>"
.	"Web: $web<br><hr><br>";

$i++;
}
?>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
