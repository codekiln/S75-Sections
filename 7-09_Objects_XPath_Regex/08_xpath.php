<?php
$out = '';

$out .= 
'
<div class="page-header">
  <h1>XPath and SimpleXMLElement</h1>
</div>
<ul>
<li><a href="http://php.net/manual/en/class.simplexmlelement.php">SimpleXMLElement
Documentation</a></li>
<li><a target="" href="https://github.com/codekiln/S75-Sections#xpath">My notes on XPath in README.md</a></li>
<li><a target="" href="http://en.wikipedia.org/wiki/List_of_U.S._state_abbreviations">example 1</a></li>
<li><a target="" href="http://www.modernhealthcare.com/gallery/20120421/PHOTO/421009999/PH&Params=Itemnr=2">example 2</a></li>
</ul>
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

