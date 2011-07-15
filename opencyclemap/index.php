<?php
if( $handle = opendir('.')) {
	$examples = array();
	$maxFnumber = 0;
	while( false !== ($file = readdir($handle))) {
		if( preg_match( "/.*map\d\d\.php/", $file ) ) {
			$num = intval(preg_replace( 
				"/.*map(\\d+).*php/", 
				"\\1", $file ));
			$maxFnumber = max($num,$maxFnumber);
		}
	}
	closedir($handle);
}
?>
<html>
  <head>
    <title>Open Cycle Map Progressive Enchancement</title>
  </head>
  <body>
  	<h1>Examples</h1>
	<ul>
	<?php 
		for( $i = 0; $i < $maxFnumber; $i++ ){
			echo "<li>";
			$fname = "map" . sprintf("%02d", $i+1) . ".php";
			echo "<a href='" . $fname . "'>Map " . $i . "</a>";
			echo "</li>";
		}
	?>
	</ul>
  </body>
</html>
