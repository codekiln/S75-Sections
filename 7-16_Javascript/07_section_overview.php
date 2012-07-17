<?php
// app07: Right now we only support getting one post at a time.
// Also, there is an implicit assumption that the guids start at
// '1' and go up in sequential increments, from newest to oldest.
// That is an unreasonable data structure for a blog; one would
// have to rename each post every time one wanted to add a new
// one, and it goes against the spirit of XML. 

define('APP_FOLDER','app07/');
define('M', APP_FOLDER . 'model/');
define('V', APP_FOLDER . 'view/');
define('C', APP_FOLDER . 'controller/');

// now start the controller
require(C . "controller.php");
