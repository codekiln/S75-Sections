<?php 
$post_number_to_display = 
    (isset($_GET['post_number'])) 
    ? (int)$_GET['post_number'] 
    : 1;
// each key will be filled in by the model, either with the
// result of a calculation using the specified values as
// parameters, or by providing a default value
$data = array( 
    'max_number_of_posts_to_display' => 1
  , 'post_number_to_display' => $post_number_to_display
    // all post data will be in this variable
  , 'posts_to_display' => ''
  , 'blog_title' => 'default blog title will be replaced'
  , 'blog_subtitle' => 'default blog subtitle will be replaced'
    // all urls are in here
    // base url of blog
  , 'url_base' => ''
    // empty if no next post is available
  , 'url_next_post' => ''
    // empty if no next post is available
  , 'url_previous_post' => ''
);

// the data variable will be filled in the model 
include(M . "model.php");
// now the $data var contains the results of each query 
// and a few more pieces of stored state

// echo "<pre>"; print_r( $data ); echo "</pre>";
include(V . "view.php");
