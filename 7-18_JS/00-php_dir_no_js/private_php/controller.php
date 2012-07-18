<?php
include( PHP_DIR . '/model.php' );
$data['directory_html'] = php_file_tree( APP_DIR ); 
$data['title'] = APP_DIR;
include( PHP_DIR . '/view.php' );
