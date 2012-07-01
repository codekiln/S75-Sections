<?php
$purpose = "
Handle the <a
href=\"$fname/%22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cfoo%22\">the
same xss link as in the previous example</a>
and introduce a form to move the tile around.  

";
$exampleParams ='?zoom=15&lat=42.374444&lon=-71.116944';
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
$queryUrl="http://www.opencyclemap.org/search.php?q=";
$zoom = (isset($_GET['zoom'])) ? $_GET['zoom'] : 15; 
$lat = (isset($_GET['lat'])) ? $_GET['lat'] : 42.37447; 
$lon = (isset($_GET['lon'])) ? $_GET['lon'] : -71.11952; 
$xTile = getXTile( $lat, $lon, $zoom );
$yTile = getYTile( $lat, $lon, $zoom );
$xTile = (isset($_GET['x'])) ? $_GET['x'] : $xTile; 
$yTile = (isset($_GET['y'])) ? $_GET['y'] : $yTile; 
if( isset( $_GET['move'] ) ) {
  if( isset( $_GET['north'] ) ) {
	$yTile--;
  }
  if( isset( $_GET['south'] ) ) {
  	$yTile++;
  }
  if( isset( $_GET['west'] ) ) {
	$xTile--;
  }
  if( isset( $_GET['east'] ) ) {
	$xTile++;
  }
}
$cacheName = getCachedFname($xTile, $yTile, $zoom);

// get this file's name
// note: vulnerable to xss: 
// $fname = $_SERVER['PHP_SELF'];
// instead: 
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).*/", 
  "\\1", $fname );
?>
<html>
  <head>
    <title>map<?php echo $fnumber ?>.php</title>
  </head>
  <body>
<h1>map<?php echo $fnumber ?>.php</h1>
	<? printGet(); ?>
	Example parameters: 
<a href="<?=$fname.$exampleParams?>">
<?=$exampleParams?></a>
<p><?=$purpose?></p>
<div id="example">
  <img src="<?php echo $cacheName?>" 
    alt="cycle map of latitude $lat, 
      longitude $lon, and zoom $zoom" />
<form action="<?php echo $fname ?>" method="get">
<input type="submit" name="north" value="North"/>
<input type="submit" name="west" value="West"/>
<input type="submit" name="east" value="East"/>
<input type="submit" name="south" value="South"/>
<input type="text" name="go" value="Cambridge, MA"/>
<input type="hidden" name="zoom" value="<?php echo $zoom ?>"/>
<input type="hidden" name="x" value="<?php echo $xTile ?>"/>
<input type="hidden" name="y" value="<?php echo $yTile ?>"/>
<input type="hidden" name="move" value="true"/>
</form>

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
