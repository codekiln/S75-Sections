<?php
$purpose = "A simple statement about example purpose"
 . " appears at the top of the page";


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

?>
<div id="example">
	<p>Your great example code goes here</p>
</div><!-- end of example div -->
</body>
</html>
