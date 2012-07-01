<?php 
$purpose = "Save remote image locally to prevent
querying remote server again and again. Note that
each time this page is called, the image is cached
again even if it is already in the cache, which
defeats the purpose of caching.";  
/**
 * cf: http://localhost/s75/1/map2.php
 *
 * Purpose: to make a progressive enhancement based
 * google-maps-like interface
 * 
 * Author: Peter Nore
 * Date: July 6, 2011
 */

  $remoteImageFilename = "http://a.tile.opencyclemap.org/cycle/14/4944/6053.png";
  // strip away everything except for /14/4944/6053
  $localImageFilename = preg_replace("/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/","\\4", $remoteImageFilename);
	// change directory separator "/" into underscore "_" to be suitable for fname
  $localImageFilename = preg_replace("/\//","_",$localImageFilename);
  $localImageDirectory = "images";
	// use the "." concatenate operator to assemble the cache filename
  $cacheName = $localImageDirectory . "/" . $localImageFilename . ".png";
	// make filename 14_4944_6053.png in images directory
	// echo "$cacheName";
	// get the remote image
  $image = file_get_contents($remoteImageFilename); 
	// store it locally
  file_put_contents($cacheName, $image);
?>
<html>
  <head>
    <title>Map 2</title>
  </head>
  <body>
<h1>Map 2</h1>
<p><?php echo $purpose; ?></p>
<img src="<?php echo $cacheName ?>"/>
</body>
</html>
