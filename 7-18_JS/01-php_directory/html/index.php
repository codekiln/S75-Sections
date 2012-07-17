<?php 

define('APP_DIR', dirname(__dir__) );

define('PUBLIC_DIR', APP_DIR . '/html' );
define('PHP_DIR', APP_DIR . '/private_php');

define('BASE_URL',dirname($_SERVER['PHP_SELF']));
define('CSS_URL_DIR', BASE_URL . '/css' );
define('IMG_URL_DIR', BASE_URL . '/img' );
define('JS_URL_DIR', BASE_URL . '/js' );

include( PHP_DIR . '/controller.php' );
