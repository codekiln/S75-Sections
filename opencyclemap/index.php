<?php
error_reporting( E_ALL ^ E_STRICT );
$examplePrefix = "map";
if( $handle = opendir('.')) {
	$examples = array();
	$maxFnumber = 0;
	while( false !== ($file = readdir($handle))) {
		if( preg_match( "/.*" . $examplePrefix . "\d\d\.php/", $file ) ) {
			$num = intval(preg_replace( 
				"/.*" . $examplePrefix . "(\\d+).*php/", 
				"\\1", $file ));
			$maxFnumber = max($num,$maxFnumber);
		}
	}
	closedir($handle);
}
?>
<html>
  <head>
    <title>Examples</title>
  </head>
  <body>
  	<h1>Examples</h1>
	<table border="1">
	<?php 
		for( $i = 0; $i < $maxFnumber; $i++ ){
			$fname = $examplePrefix . sprintf("%02d", $i+1) . ".php";?>
			<tr>
			<td><?=$fname?><td>
			<td><a target='blank' href='<?= $fname?>'>new tab</a></td>
			<td><a id="display-source-<?=$i?>" href="#display-source-<?=$i?>">show source</a>
				<pre style="display:none;">
					<?= htmlspecialchars(file_get_contents($fname)) ?>
				</pre></td>
			<td><a 
			  href='#' 
			  onclick="
			  	window.frames['<?=$fname?>']
				  .location='<?=$fname?>';
			  "
			  >load <?=$fname?></a>
			  <iframe name='<?=$fname?>' src=''>
					<p>Your browser does not support iframes.</p>
			  </iframe>
			 </td>
		<?}?>
  </body>
</html>
