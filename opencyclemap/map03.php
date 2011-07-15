<?php  
/**
 * map3.php: save remote image locally, but this time only if
 * the image isn't already in the cache
 * cf: http://localhost/s75/1/map3.php
 *
 * Purpose: to make a progressive enhancement based
 * google-maps-like interface
 * 
 * Author: Peter Nore
 * Class: S-75
 * Date: July 6, 2011
 */
  $remoteImageFilename = "http://a.tile.opencyclemap.org/cycle/14/4944/6053.png";
	// strip away everything except for /14/4944/6053
  $localImageFilename = preg_replace("/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/","\\4", $remoteImageFilename);
	// change directory separator "/" into underscore "_"
  $localImageFilename = preg_replace("/\//","_",$localImageFilename);
  $localImageDirectory = "images";
	// use the "." concatenate operator to assemble the cache filename
  $cacheName = $localImageDirectory . "/" . $localImageFilename . ".png";
	// make filename 14_4944_6053.png
	// go get the remote image only if it's not in the cache
	// notice what happens if you do not include @ - it suppresses warnings
	// notice === to test for explicit false
  if(@file_get_contents($cacheName)===false){
	  $image = file_get_contents($remoteImageFilename); 
	  file_put_contents($cacheName, $image);
  } 
?>
<html>
  <head>
    <title>Map 3</title>
  </head>
  <body>
<h1>Map 3</h1>
<img src="<?php echo $cacheName ?>"/>
<?php echo "<br/><strong>$cacheName</strong>"; ?>
</body>
</html>
