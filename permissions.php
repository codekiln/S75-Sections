<?php 
$dir = dirname( __FILE__ );
$extensions_to_chmod_644 = array(
"jpg","gif","png","ico","css","md","txt","html","htm","xml","js","csv","json","htaccess");
$extension_separator = "\|";
$command_to_chmod_644 = 'find "' . $dir . '" -type f -iregex ".*\.\(';
foreach( $extensions_to_chmod_644 as $ext ) {
  $command_to_chmod_644 .= $ext . $extension_separator;
}
$command_to_chmod_644 =
rtrim($command_to_chmod_644,$extension_separator);
$command_to_chmod_644 .= '\)$" -print0 | xargs -0 chmod 644'. PHP_EOL;
shell_exec($command_to_chmod_644);

$command_to_chmod_755 = "find '$dir' -type d -print0 | xargs -0 chmod 755" . PHP_EOL;
shell_exec($command_to_chmod_755);
