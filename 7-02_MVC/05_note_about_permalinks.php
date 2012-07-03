<?php
$out = "";

$out .= 
"
<div class='page-header'>
  <h1>On Generating Links in PHP</h1>
</div>
<p>When thinking about printing out links to the screen using PHP,
you have to be careful. There are a number of interesting
problems to think about here. One possible innovation we could
introduce to our blogging system at this point would be to make
it so people could pull up an article by its title in the url. Consider the following url:
<pre>
http://www.example.com/index.php?pageTitle=Correct Usage of &lt;pre&gt;
</pre>
This url has several problems. If you wanted to
link to the page title (as is customary with blogs) you would
have to think ahead to achieve the effect: </p>
";
$path = 'php/created/page/url.php'; 
$pageTitle = "Correct Usage of <pre>"; 
$pageTitleLinkText = $pageTitle;

$url = "http://localhost/";
$url .= rawurlencode($path);
$url .= "?pageTitle=" . urlencode($pageTitle);

?>
<?php 
$var1 = "<a href='" . htmlspecialchars($url) . "'>"
 . htmlspecialchars($pageTitleLinkText) . "</a>";
$out .= "
<div class='well'>
  <h2>$var1</h2><pre>" . htmlspecialchars($var1) .
"</pre>
</div>
";
define('APP_FOLDER','app04/');
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

