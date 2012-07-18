<?php
include( PHP_DIR . '/model.php' );
$data['directory_html'] = php_file_tree( APP_DIR ); 

// 1.) split the directory path on a slash
$directory_folders = explode( "/", APP_DIR );

// 2.) remove four or five folders from the left 
// remove /home/user/public_hmtl/S75-Sections
$directory_folders = array_slice( $directory_folders, 5 ); 

// 3.) join the new array into a path with slash
$data['title'] = implode( "/", $directory_folders );

include( PHP_DIR . '/view.php' );
