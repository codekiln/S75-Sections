<?php
$purpose = "
Send different content depending on whether the request
was from Ajax. The Ajax example is from 
<a href='http://www.w3schools.com/ajax/default.asp'>
this w3c tutorial</a>.
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

$ajaxOnlyContent = "this was sent from ajax";

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
