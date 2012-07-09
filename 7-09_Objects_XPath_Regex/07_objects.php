<?php
$out = '';

$out .= 
'
<div class="page-header">
  <h1>Objects in PHP</h1>
</div>
<ul><li><a
href="http://www.php.net/manual/en/language.oop5.basic.php">basic
oop in php5</a></li></ul>
<p></p>
';
define('APP_FOLDER','app06/');
define('V', APP_FOLDER . 'view/');
echo 
"
<!DOCTYPE html>
<html lang='en'>
  <head>
";
include(V.'header-content.php');
echo 
"
  </head>
  <body>$out</body></html>";

