<?php 

// each key will be filled in by the model, either with the
// result of a calculation using the specified values as
// parameters, or by providing a default value
$data = array( 
    'max_number_of_posts_to_display' => 1
    // http://goo.gl/DmOSg
  , 'first_post_guid_to_display' => (int) @$_GET['post_number'] ?: 1
    // all post data will be in this variable
  , 'posts_to_display' => new object(); 
  , 'blog_title' => 'default blog title will be replaced'
  , 'blog_subtitle' => 'default blog subtitle will be replaced'
    // all urls are in here
  , 'url' => array(
    // base url of blog
    'base' => ''
      // empty if no next post is available
    , 'next_post' => ''
      // empty if no next post is available
    , 'previous_post' => ''
  )
);

// the data variable will be filled in the model 
include(M . "model.php");
// now the $data var contains the results of each query 

$post_number_to_display =
  (int)$data['posts_to_display'][0]->guid;

$data['number_of_posts'] = count($data['posts_to_display']);

// get the url this page was requested with
// http://php.net/manual/en/reserved.variables.server.php
$blog_url = $_SERVER['REQUEST_URI'];

// strip out the GET parameters and save things before '?'
// http://php.net/manual/en/function.strtok.php
$blog_url = strtok($blog_url, '?');

// save the url in the data for the view
$data['url']['base'] = $blog_url;

// prepare both previous and next post urls
    $data['url']['previous_post'] 
  = $data['url']['next_post'] 
  = $blog_url . '?post_number='; 

// enforce a minimum post number of 1
if( $post_number_to_display < 2 ) {
  // indicate to the view that there is not a previous post 
    $data['url']['previous_post'] = ''; 
} else {
    $data['url']['previous_post'] .= $post_number_to_display-1 ;
}

//  similarly enforce the maximum post number
//  (a different way to accomplish same thing)

if ( $post_number_to_display >= $data['number_of_posts'] ) {
  // set the next post to blank to indicate there is no next post
  $data['url']['next_post'] = '';
} else {
  // append the correct number on
  $data['url']['next_post'] .= $post_number_to_display+1;
}

// echo "<pre>"; print_r( $data ); echo "</pre>";
include(V . "view.php");
