<?php
require('handy.php');
$purpose = "
Input contact information from form through POST into
database, validating the information before submitting.
Assumes you have created jharvard_example2 database.
Based off of <a
href='http://wwwfreewebmasterhelpcom/tutorials/phpmysql/2'>
this tutorial</a>'
";

$exampleParams ='';
$user="jharvard";
$password="crimson";
// make sure you have this database set up!
$database="jharvard_example2";
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).php/", 
  "\\1", $fname );

$first="";
$last="";
$phone="";
$mobile="";
$fax="";
$email="";
$web="";

if( count($_POST) > 0 ) {
	// note that if we want to use these variables
	// outside of this function, we have to declare 
	// that they are not local
	global $first, $last, $phone, $mobile, $fax, $email, $web;
	// you could do this ... 
	//$_POST = array_map("htmlspecialchars", $_POST );
	//$_POST = array_map("mysql_real_escape_string", $_POST );
	// or you could do this ...
	$first=mysql_real_escape_string($_POST['first']);
	$last=mysql_real_escape_string($_POST['last']);
	$phone=mysql_real_escape_string($_POST['phone']);
	$mobile=mysql_real_escape_string($_POST['mobile']);
	$fax=mysql_real_escape_string($_POST['fax']);
	$email=mysql_real_escape_string($_POST['email']);
	$web=mysql_real_escape_string($_POST['web']);
	echo $first;

	// see http://rubular.com/r/7OsFvCe56W
	// via http://stackoverflow.com/questions/201323/what-is-the-best-regular-expression-for-validating-email-addresses 
	$email_regex = 
		'/^[_a-z0-9-]+' // john 
		. '(\.[_a-z0-9-]+)*' // .harvard 
		. '@[a-z0-9-]+' // @fas
		. '(\.[a-z0-9-]+)*' // .harvard
		. '(\.[a-z]{2,4})$/'; // .edu
	$hasError = array();
	$email = strtolower($email);
	if(!preg_match( $email_regex, $email ) ) {
		$hasError['email'] = "Your email may "
		. "consist of characters A-Z, a-z, 0-9, "
		. " underscore (_), or hyphen (-)."
		. " It must contain an at symbol (@) in the"
		. " middle, and the TLD must not be"
		. " longer than four characters.";
	}
	if( count($hasError) == 0  ) {

		mysql_connect(localhost,$username,$password);
		if(! @mysql_select_db($database) ) {
			$hasError['mysql_no_db'] = mysql_error(); 
		} else {
			$query = "INSERT INTO contacts VALUES ('',
				$first ',' $last ',' $phone','$mobile
					','$fax','$email','$web')";
			$result = mysql_query($query);
			if( !$result ) {
				$hasError['mysql_result'] = mysql_error(); 
			}
		}
		mysql_close();
	} 
}
?>
<html>
  <head>
    <title><?=$fname?></title>
	<style type="text/css">
</style>
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

<?php  // handle errors
if( count( $hasError ) > 0 ) {
	foreach( $hasError as $err_key=>$err_value) {
		/** style taken from serverfault.com **/
		echo "<div style='
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0.95);
    border-bottom: 1px solid black;
    box-shadow: 0 1px 15px #9C9C9C;
    font-size: 20px;
    font-weight: bold;
    left: 0;
    line-height: 20px;
    padding: 10px 10%;
    position: fixed;
    text-align: center;
    top: 0;
    width: 80%;
	'>";
		echo $err_value;
		echo "</div>";
	}
}// end of error handling
?>
<?=($first=="")?"empty":"$first"?>
<form action="<?=$fname?>" method="post">
  First Name: <input type="text" name="first" value="<?=$first?>"><br>
  Last Name: <input type="text" name="last" value="<?=$last?>"><br>
  Phone: <input type="text" name="phone" value="<?=$phone?>"><br>
  Mobile: <input type="text" name="mobile" value="<?=$mobile?>"><br>
  Fax: <input type="text" name="fax" value="<?=$fax?>"><br>
  E-mail: <input type="text" name="email" value="<?=$email?>"><br>
  Web: <input type="text" name="web" value="<?=$web?>"><br>
	<input type="Submit">
</form>
<?php /** end of example div ****************/ ?></div>
</body>
</html>
