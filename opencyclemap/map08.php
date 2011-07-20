<?php
/**
 * move functions to external file functions.php
 * cf: http://www.opencyclemap.org/?zoom=14&lat=42.46052&lon=-71.3489
 * cf: http://localhost/s75/1/map7.php?zoom=15&lat=42.374444&lon=-71.116944
 *
 * Purpose: to make a progressive enhancement based
 * google-maps-like interface
 * 
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
$fname = __FILE__;
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).php/", 
  "\\1", $fname );

/**
 * Handy print array function for debugging
 */
function pr($arr) {
	echo '<pre>', htmlspecialchars(print_r($arr, true)), "</pre>\n";
}

/**
  * Handy function that will print the GET params
  * if there are any
  */
function printGet() {
	if( count($_GET) > 0 ) {
		echo "<h2>Passing in GET parameters:</h2>";
		pr( $_GET );
	}
}
?>
<html>
  <head>
    <title>map<?php echo $fnumber ?>.php</title>
  </head>
  <body>
<h1>map<?php echo $fnumber ?>.php</h1>
	<? printGet(); ?>
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
</body>
</html>
