<?php
/**
 * map5.php: capture latitude and longitude parameters
 * cf: http://localhost/s75/1/map6.php?zoom=14&lat=42.46052&lon=-71.3489
 * cf: http://www.opencyclemap.org/?zoom=14&lat=42.46052&lon=-71.3489
 *
 * Purpose: to make a progressive enhancement based
 * google-maps-like interface
 * 
 * Author: Peter Nore
 * Date: July 6, 2011
 */
// get the GET parameters
// default: ?zoom=15&lat=42.37447&lon=-71.11952
$zoom = (isset($_GET['zoom'])) ? $_GET['zoom'] : 15; 
$lat = (isset($_GET['lat'])) ? $_GET['lat'] : 42.37447; 
$lon = (isset($_GET['lon'])) ? $_GET['lon'] : -71.11952; 

  $remoteImageFilename = 
    "http://a.tile.opencyclemap.org/cycle/14/4944/6053.png";
  // strip away everything except for /14/4944/6053
  $localImageFilename = preg_replace(
    "/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/","\\4", 
    $remoteImageFilename);
    // replace the forward slash '/' with underscore '_'
  $localImageFilename = preg_replace("/\//","_",
    $localImageFilename);
  $localImageDirectory = "images";
  $cacheName = 
    $localImageDirectory . "/" . $localImageFilename . ".png";

  // make filename 14_4944_6053.png
  // echo "$cacheName";
  // go get the remote image only if it's not in the cache
  // check to make sure it is strictly equal to false (===)
  if(file_exists($cacheName)===false){
          $image = file_get_contents($remoteImageFilename); 
          file_put_contents($cacheName, $image);
  } 

  // get this file's name
  $fname = __FILE__;
  //echo( "<br/>".$fname );
  // get the number before .php
  $fnumber = preg_replace( "/.*map(\\d+).php/", 
    "\\1", $fname );
  //echo( "<br/>".$fnumber );
?>
<html>
  <head>
    <title>map<?php echo $fnumber ?>.php</title>
  </head>
  <body>
<h1>map<?php echo $fnumber ?>.php</h1>
  <img src="<?php echo $cacheName ?>" 
    alt="cycle map of latitude $lat, 
      longitude $lon, and zoom $zoom" />
<?php
// NOTE - you shouldn't echo submitted parameters without 
// htmlspecialchars in production code because of XSS risk.
// it is probably fine without it here for example purposes. 
echo "<br/><b>cacheName: </b>$cacheName"; 
echo "<br/><b>zoom:</b>$zoom"; 
echo "<br/><b>lat:</b>$lat"; 
echo "<br/><b>lon:</b>$lon<br/>"; 
?>
</body>
</html>
