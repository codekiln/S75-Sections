<?php
$purpose = "
Even more refactoring. Now, the class
instantiation is inside a function getMap() in
functions.php. Also, javascript is passed to the
getHeader() function, and it is subsequently used
in a demo. 
";
$exampleParams ='?zoom=15&lat=42.374444&lon=-71.116944';

require('functions.php');
$map = getMap(); 

$javascript = <<< EOF
<script type="text/javascript">
function displayDate()
{
document.getElementById("demo").innerHTML=Date();
}
</script>
EOF;

echo $map->getHeader($javascript);
?>
<button type="button" onclick="displayDate()">
    Execute Javascript</button>
<p id="demo">This is a test paragraph
for the javascript.</p>
<?
echo $map->getNavigation();
echo $map->getImage();
echo $map->getFooter();
?>  
