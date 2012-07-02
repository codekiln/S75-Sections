<?php 

// NEW in app03: control post number to display
$post_number_to_display = 1;

// NEW in app04: take the post number to display from GET
if( isset($_GET['post_number']) ) {
  $post_number_to_display = 
    intval( $_GET['post_number'] );

  // finally, make sure it's not less than 1
  if( $post_number_to_display < 1 ) {
    $post_number_to_display = 1;
  }
} 

// NEW in app03: conduct multiple queries at once
$data = array( 
  'posts_to_display' => 
      "(/rss/channel/item)[position() = {$post_number_to_display}]"
  , 'number_of_posts' => 
      "/rss/channel/item"
);

// the data variable will be filled in the model according to the
// queries
include(M . "model.php");

// now the $data var contains the results of each query 

// NEW in app04: add post_number_to_display to $data 
// array to pass to view 
// 
// see http://www.php.net/manual/en/function.compact.php
// see http://php.net/manual/en/function.array-push.php
$data['post_number_to_display'] =  $post_number_to_display;

$data['number_of_posts'] = count($data['number_of_posts']);

// NEW in app04: include the blog url for the page links
// in the $data var
$blog_url = $_SERVER['REQUEST_URI'];

// see
// http://php.net/manual/en/function.strtok.php
$blog_url = strtok($blog_url, '?');
$blog_url .= '?post_number=';

$data['previous_post_url'] = 
  $data['next_post_url'] = $blog_url; 

if( $post_number_to_display<2 ) {
    $data['previous_post_url'] = ''; 
} else {
    $data['previous_post_url'] .= $post_number_to_display-1 ;
}

if($post_number_to_display>=$data['number_of_posts']) {
    $data['next_post_url'] = ''; 
} else {
    $data['next_post_url'] .= $post_number_to_display+1;
}

//  echo "<pre>";print_r( $data );echo "</pre>";
include(V . "view.php");
