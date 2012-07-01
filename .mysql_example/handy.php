<?php
/**
  * tiny functions to include in examples
  * Author: Peter Nore
  * Created: July 20, 2011
  */

/**
 * Handy print array function for debugging
 */
function pr($arr) {
	echo '<pre>', htmlspecialchars(print_r($arr, true)), "</pre>\n";
}

/**
  * Handy function that will print the GET params
  * if there are any
  */
function printGet() {
	if( count($_GET) > 0 ) {
		echo "<h2>Query: ?" . $_SERVER['QUERY_STRING'] . "</h2>";
		pr( $_GET );
	}
}

