<?php 


// NEW in app03: control post number to display
$post_number_to_display = 1;

// NEW in app03: conduct multiple queries at once
$data = array( 
  'posts_to_display' => 
    "(/rss/channel/item)[position() = {$post_number_to_display}]"
  , 'number_of_posts' => 
    "count(/rss/channel/item)"
);

// the data variable will be filled in the model according to the
// queries
include(M . "model.php");

// now the $data var contains the results of each query 

// for app04: add post_number_to_display to $data 
// array to pass to view 
// see http://www.php.net/manual/en/function.compact.php
// see http://php.net/manual/en/function.array-push.php
// array_push( $data, compact( 'post_number_to_display') );

include(V . "view.php");
