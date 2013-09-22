<?php 
$purpose = "You can gain access to the current file name with "
."__FILE__ or with \$_SERVER['PHP_SELF']";
$exampleParams ="?"; 
/**
 * cf: http://localhost/s75/1/map5.php
 * Author: Peter Nore
 * Date: July 6, 2011
 */
$remoteImageFilename = "http://a.tile.opencyclemap.org/cycle/14/4944/6053.png";
// strip away everything except for /14/4944/6053
$localImageFilename = preg_replace(
  "/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/",
  "\\4", $remoteImageFilename);
// replace the forward slash '/' with underscore '_'
$localImageFilename = 
  preg_replace("/\//","_",$localImageFilename);
$localImageDirectory = "images";
$cacheName = $localImageDirectory . "/" . $localImageFilename . ".png";
// make filename 14_4944_6053.png
// echo "$cacheName";
// go get the remote image only if it's not in the cache
// check to make sure it is strictly equal to false (===)
if(file_exists($cacheName)===false){
  $image = file_get_contents($remoteImageFilename); 
  file_put_contents($cacheName, $image);
	chmod($cacheName,644);
} 

// get this php file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
//echo( "<br/>".$fname );
// extract the number from this file's name
$fnumber = preg_replace( "/.*map(\\d+).php/", "\\1", $fname );
//echo( "<br/>".$fnumber );

?>
<html>
  <head>
    <title>Map <?php echo $fnumber ?></title>
  </head>
  <body>
<h1>map<?php echo $fnumber ?>.php</h1>
<a href="<?=$fname.$exampleParams?>">Example Url</a>
<p><?php echo $purpose; ?></p>
  <img src="<?php echo $cacheName ?>" 
    alt="cycle map"/>
<?php
echo "<br/><strong>filename: </strong>$cacheName"; 
?>
</body>
</html>
