<?php
$purpose = 'Demonstrate a form that lets a user  
login with a predefined password.';
$exampleParams = '';
session_start();

/* {{{ BEGIN EXAMPLE BOILERPLATE */

require('handy.php');
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
?>
<html>
  <head>
    <title><?php echo $fname?></title>
  </head>
  <body>
<h1><?php echo  $fname ?></h1><?php
	printGet(); 
    if(strlen($exampleParams)>0) { 
            echo "Example parameters: 
                <a href='{$fname}{$exampleParams}'>
                $exampleParams</a>";
        } ?>
<p><?php echo $purpose ?></p>
<div id="example"><?php // beginning of example div ?>
<?php 

/* END EXAMPLE BOILERPLATE }}} */

$correctUsername = 'registeredUser';
$correctPassword = 'trustno1';

if( 
    // if logged in 
    (isset($_SESSION['logged_in'])
        && $_SESSION['logged_in'] == true )
    || // or if correct username and password are entered
    (isset($_POST['username'])
        && $_POST['username'] == $correctUsername
        && isset($_POST['password'])
        && $_POST['password'] == $correctPassword )
) { // then do logged in things
    $_SESSION['logged_in'] = true;
?>
<h1> you are logged in </h1>
<?php 
} else {
    $_SESSION['logged_in'] = false;
?> 
<form method='POST' action='example03.php'>
<input 
    name='username'
    onfocus="if (this.value=='username') this.value = ''"
    type='text'
    value='username'/>
<input 
    name='password'
    onfocus="if (this.value=='password') this.value = ''"
    type='password'
    value='password'/>
<input
    name='submit'
    type="submit"/>
</form>
<?php } // end of if not logged in ?>
</div><?php // end of example div ?>
</body>
</html>
