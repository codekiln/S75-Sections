<?php
define('APP_FOLDER','app01/');
define('M', APP_FOLDER . 'model/');
define('V', APP_FOLDER . 'view/');
define('C', APP_FOLDER . 'controller/');

/*
I'm going to guess that you downloaded this folder from Git,
which would have obliterated it's permissions. You are able to
change file permissions in PHP, so I'm going to do that here to
make sure you are able to view the subdirectories of this folder. 
*/

require('../permissions.php');
// now start the controller
require(C . "controller.php");
