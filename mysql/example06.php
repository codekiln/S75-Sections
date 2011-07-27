<?php
require('handy.php');
$purpose = "Send a message if there are no "
  . "records in the database and order by last "
  . "name."
  . " Based off of "
  . "<a href='http://www.freewebmasterhelp.com/tutorials/phpmysql/2'>"
  . "this tutorial</a>.";
$exampleParams ='';
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).php/", 
  "\\1", $fname );

$username="jharvard";
$password="crimson";
$database="jharvard_example2";

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
/** THIS IS NEW - ORDER BY **/
$query="SELECT * FROM contacts ORDER BY last ASC";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
echo "<hr/>";

echo "<b><center>Database Output</center>"
.	"</b><br><br>";
if ($num==0) {
	/** THIS IS NEW **/
echo "The database contains no contacts yet";
} else {
	?>
		<table border="0" cellspacing="2" cellpadding="2">
		<tr>
		<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Phone</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Mobile</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Fax</font></th>
		<th><font face="Arial, Helvetica, sans-serif">E-mail</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Website</font></th>
		</tr>

		<?
		$i=0;
	while ($i < $num) {

		$first=mysql_result($result,$i,"first");
		$last=mysql_result($result,$i,"last");
		$phone=mysql_result($result,$i,"phone");
		$mobile=mysql_result($result,$i,"mobile");
		$fax=mysql_result($result,$i,"fax");
		$email=mysql_result($result,$i,"email");
		$web=mysql_result($result,$i,"web");
		?>

			<tr>
			<td><font face="Arial, Helvetica, sans-serif"><? echo $first." ".$last; ?></font></td>
			<td><font face="Arial, Helvetica, sans-serif"><? echo $phone; ?></font></td>
			<td><font face="Arial, Helvetica, sans-serif"><? echo $mobile; ?></font></td>
			<td><font face="Arial, Helvetica, sans-serif"><? echo $fax; ?></font></td>
			<td><font face="Arial, Helvetica, sans-serif"><a href="mailto:<? echo $email; ?>">E-mail</a></font></td>
			<td><font face="Arial, Helvetica, sans-serif"><a href="<? echo $web; ?>">Website</a></font></td>
			</tr>

			<?
			$i++;
	}


	echo "</table>";
}
?>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
