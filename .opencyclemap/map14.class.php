<?php
$purpose = "
Introduce firebug development and JSON. In
firefox, type about:config into the title bar,
	search for cache, then turn disk enable to
	false, and network use cache to false. This
	will make it easier to develop and know that
	our old javascript hasn't been cached if you
	are working from an external file.  Be sure to
	turn it on again when you are using your
	browser regularly.
";
$exampleParams ='?zoom=15&lat=42.374444&lon=-71.116944';

require('functions.php');
$map = getMap(); 

define('IS_AJAX', 
	isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) 
	== 'xmlhttprequest');

$javascript = <<< EOF
<script type="text/javascript">
function loadXMLDoc()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("demo")
				.innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","$fname",true);
	xmlhttp.setRequestHeader("X-Requested-With", 
			"XMLHttpRequest");
	xmlhttp.send();
}
</script>
EOF;

$ajaxOnlyContent = $map->getParamJson();

if(IS_AJAX) {
  	die($ajaxOnlyContent);
} else {
	echo $map->getHeader($javascript);
	?>
		<button type="button" onclick="loadXMLDoc()">
		Execute Javascript</button>
		<p id="demo">This is a test paragraph
		for the javascript.</p>
			<?
				echo $map->getNavigation();
	echo $map->getImage();
	echo $map->getFooter();
}
