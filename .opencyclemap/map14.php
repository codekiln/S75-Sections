<?php
$purpose = "
1.) Factor the JS into its own file and use it to make
an asynchronous update to the image from the buttons.
2.) Define IS_AJAX inside the map class constructor.
3.) Demonstrate Object Oriented Javascript
";
$exampleParams ='?zoom=15&lat=42.374444&lon=-71.116944';

require('functions.php');
$map = getMap(); 

if(IS_AJAX) {
	$ajaxOnlyContent = $map->getParamJson();
  	die($ajaxOnlyContent);
} else {
	$jsFileName = 'map' . $fnumber . '.js';
	$currentLocation = $map->getParamJson(); 
	$headerContent = 
	"<script type='text/javascript' src='$jsFileName'></script>
	<script type='text/javascript'>
	// <![CDATA[
		var myLoc = new Tile($currentLocation);
		var myMap = new Map('$fname', myLoc);
	//]]>
	</script>";
	$html = '';
	$html .= $map->getHeader($headerContent);
	// google heredocs for this syntax
	// http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
	/**$html .= <<< HEREDOC
	<button type="button" onclick="theMap.changeImage()">
		Execute Javascript</button>
	<p id="demo">This is a test paragraph
		for the javascript.</p>
	HEREDOC;
	**/
	$html .= $map->getNavigation();
	$html .= $map->getImage();
	$html .= $map->getFooter();
	echo $html;
} 
