<?php
$purpose = "
Now we have moved the functions to an external
file functions.php by including it.  In this
example we will address the security risk
associated with echoing the result of
\$_SERVER['PHP_SELF'] back to the user.  We have
been getting the example number from
\$_SERVER['PHP_SELF'], which is '<strong>" .
htmlspecialchars($_SERVER['PHP_SELF']) .
"</strong>' for this file.  In PHP,
	'localhost/map08.php<strong>/some/more/params</strong>'
	is a perfectly valid url, and the additional
	parameters do appear in \$_SERVER['PHP_SELF'];
	try requesting this page with <a
	href=\"map08.php/some/more/parameters\">map08.php/some/more/parameters</a>
	to see. Many times \$_SERVER['PHP_SELF']
	appears in the action attribute of forms, so
	the information is submitted to the same file
	that printed the form, like this: <pre>" .
	htmlspecialchars("<form action=\"<?=
			\$_SERVER['PHP_SELF']?>\">") . "</pre>
			For the current request this would
			look like: <pre>" .
			htmlspecialchars("<form action=\"" .
				$_SERVER['PHP_SELF'] . "\">") .
			"</pre> This represents a risk because
			an attacker could craft a link to your
			page that injects html through the url
			via \$_SERVER['PHP_SELF']: <pre>" .
			htmlspecialchars("map08.php/\"><script>alert('xss')</script><foo\"")
			. "</pre> becomes <pre>" .
			htmlspecialchars("<form
				action=\"map08.php/\"><script>alert('xss')</script><foo\">")
			. "</pre> Chances are, though, they
			will use a url encoding to make the
			request look (more) like this:
			<pre>map8.php/" .
			htmlspecialchars("%22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cfoo%22")
			. "</pre>Try the link: <a
			href=\"map8.php/".
	"%22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cfoo%22"
	."\">xss link to this page</a>. To thwart this
	you can use htmlspecialchars to sanitize the
	input to \$_SERVER['PHP_SELF'].";


$exampleParams='?zoom=15&lat=42.374444&lon=-71.116944';
require('handy.php');
/**
 * cf: http://www.opencyclemap.org/?zoom=14&lat=42.46052&lon=-71.3489
 * cf: http://localhost/s75/1/map7.php?zoom=15&lat=42.374444&lon=-71.116944
 * Author: Peter Nore
 * Date: July 6, 2011
 */
// load functions from functions.php
include('functions.php');
// get the GET parameters
// default: ?zoom=15&lat=42.37447&lon=-71.11952
$zoom = (isset($_GET['zoom'])) ? $_GET['zoom'] : 15; 
$lat = (isset($_GET['lat'])) ? $_GET['lat'] : 42.37447; 
$lon = (isset($_GET['lon'])) ? $_GET['lon'] : -71.11952; 
$xTile = getXTile( $lat, $lon, $zoom );
$yTile = getYTile( $lat, $lon, $zoom );
$cacheName = getCachedFname($xTile, $yTile, $zoom);

// get this file's name
// old: 
// $fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// new, vulnerable to xss: 
$fname = $_SERVER['PHP_SELF'];
//echo "echoing escaped fname: ".htmlspecialchars($fname);
//echo "echoing unescaped fname: $fname";
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).*/", 
  "\\1", $fname );
//echo "echoing fnumber: $fnumber";

?>
<html>
  <head>
    <title>map<?php echo $fnumber ?>.php</title>
  </head>
  <body>
<h1>map<?php echo $fnumber ?>.php</h1>
	<? printGet(); ?>
<ul>
	<li>Example parameters: 
	<a href="<?=$fname.$exampleParams?>">
	<?=$exampleParams?>
	</a></li>
<li><?=$purpose?></li>
<div id="example">
  <img src="<?php echo $cacheName?>" 
    alt="cycle map of latitude $lat, 
      longitude $lon, and zoom $zoom" />
<?php
// NOTE - you shouldn't echo submitted parameters without 
// htmlspecialchars in production code because of XSS risk.
// it is probably fine without it here for example purposes. 
echo "<br/><b>cacheName: </b>$cacheName"; 
echo "<br/><b>zoom:</b>$zoom"; 
echo "<br/><b>lat:</b>$lat"; 
echo "<br/><b>lon:</b>$lon"; 
echo "<br/><b>lon:</b>$lon"; 
echo "<br/><b>xTile:</b>$xTile"; 
echo "<br/><b>yTile:</b>$yTile"; 
?>
</div>
</body>
</html>
