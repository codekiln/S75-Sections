<?php
$out = '';

echo "<pre>";
print_r($xml = simplexml_load_file("menu.xml"));
echo "</pre>";
echo "<pre>";
$pizza_name_to_get = 'Broccoli';
$pizza_size = 'large';
echo print_r($pizza_we_want = $xml->xpath('//pizzas/item[name="Broccoli"]'));
echo '</pre>';
echo '<br/><pre>';
echo $price = (float) $pizza_we_want[0]->$pizza_size;
echo "</pre>";
echo "<br/><pre>";
echo "$".  number_format(2*$price/100, 2); 
echo "</pre>";



echo "</pre>";

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

