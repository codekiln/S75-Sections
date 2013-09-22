<?php
$purpose = "
All functions are now in a class called Map10. Map10
is in file Map10.class.php.
";
$exampleParams ='?zoom=15&lat=42.374444&lon=-71.116944';
require('handy.php');
/**
 * cf: http://www.opencyclemap.org/?zoom=14&lat=42.46052&lon=-71.3489
 * cf: http://localhost/s75/1/map7.php?zoom=15&lat=42.374444&lon=-71.116944
 * Author: Peter Nore
 * Date: July 6, 2011
 */
// get this file's name
$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
// get the number before .php
$fnumber = preg_replace( "/.*map(\\d+).*/", 
		"\\1", $fname );
/*
 all the code from last time is contained in its own
 class.  the class is relative to the number contained
 in this file.  First, source the file that has the
 class. 
 */
// in this one we are doing Map10.class.php, which 
// contains class Map10. 
include('Map'.$fnumber.'.class.php'); 
// then, instantiate the new class.
$classname = 'Map' . $fnumber; // Map10
$thisMap = new $classname(); // new Map10()
echo $thisMap->getHeader();
?> 
<img src="<?php echo $cacheName?>" 
    alt="cycle map of latitude $lat, 
      longitude $lon, and zoom $zoom" />
<form action="<?php echo $fname ?>" method="get">
<input type="submit" name="north" value="North"/>
<input type="submit" name="west" value="West"/>
<input type="submit" name="east" value="East"/>
<input type="submit" name="south" value="South"/>
<input type="text" name="go" value="Cambridge, MA"/>
<?= $thisMap->getRequiredHiddenInputs() ?>
</form>

<?= $thisMap->getFooter(); ?>
