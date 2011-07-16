<?php 
$purpose = "Use file_exists(\$path) instead of 
file_get_contents(\$path) to check for existence
of cached file.";
/**
 * cf: http://localhost/s75/1/map4.php
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
  $localImageFilename = preg_replace("/\//","_",$localImageFilename);
  $localImageDirectory = "images";
  $cacheName = $localImageDirectory . "/" . $localImageFilename . ".png";
	// make filename 14_4944_6053.png
	// go get the remote image only if it's not in the cache
	// check to make sure it is strictly equal to false (===)
  if(file_exists($cacheName)===false){
	  $image = file_get_contents($remoteImageFilename); 
	  file_put_contents($cacheName, $image);
  } 
?>
<html>
  <head>
    <title>Map 4</title>
  </head>
  <body>
<h1>Map 4</h1>
<p><?php echo $purpose; ?></p>
<img src="<?php echo $cacheName ?>"/>
<?php echo "<br/><strong>$cacheName</strong>"; ?>
</body>
</html>
