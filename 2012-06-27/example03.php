<?php
$purpose = 'Demonstrate a form that lets a user  
login with a predefined password.';
$exampleParams = '';

// check for cookie or create cookie on user machine
// load serverside ontent tied to user cookie in $_SERVER
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
	/*printGet(); 
    if(strlen($exampleParams)>0) { 
            echo "Example parameters: 
                <a href='{$fname}{$exampleParams}'>
                $exampleParams</a>";
        }*/ ?>
<p><?php echo $purpose ?></p>
<div id="example"><?php // beginning of example div ?>
<?php 

/* END EXAMPLE BOILERPLATE }}} */

define( CORRECT_USERNAME, 'registeredUser');
define( CORRECT_PASSWORD, 'trustno1');

$user_is_logged_in = 
    isset($_SESSION['logged_in'])
    && $_SESSION['logged_in'] == true;

$user_entered_correct_username = 
    isset($_POST['username'])
    && $_POST['username'] == CORRECT_USERNAME;

$user_entered_correct_password = 
    isset($_POST['password'])
    && $_POST['password'] == CORRECT_PASSWORD;

$user_wants_to_be_logged_out = 
   isset($_GET['logout']) && $_GET['logout'] == 'true';

// first, check if user wants to log out
if( $user_wants_to_be_logged_out ) {
    unset($_SESSION['logged_in']);
    $user_is_logged_in = false; 
}

// then, display different data depending on whether
// logged in
if( 
   $user_is_logged_in
   || $user_entered_correct_username
      && $user_entered_correct_password
) { // then do logged in things such as display log out
    // btn
    // we can store the fact that they are logged in here
    $_SESSION['logged_in'] = true;
?>
<h1> you are logged in </h1>
<a href="example03.php?logout=true">log out</a>
<?php 
} else { // otherwise, do "not logged in things"
    $_SESSION['logged_in'] = false;
?> 
<h3>Welcome, user! Log in here with 
<?php echo "username '" . CORRECT_USERNAME . 
           "' and password '" . CORRECT_PASSWORD . "'" ;?>
</h3>
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
<?php } // end of "if not logged in" ?>
</div><?php // end of example div ?>
</body>
</html>
