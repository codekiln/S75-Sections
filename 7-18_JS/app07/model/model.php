<?php 

// if you want, you can try it this way: 
// https://github.com/gaarf/XML-string-to-PHP-array

// load the data into a simplexml document
$xml = simplexml_load_file(M . "data.xml");

// $xml now has a SimpleXMLElement object in it;
// that SimpleXMLElement object exposes an xpath function
// that lets us render xpath queries on it. 

function posts_to_display( $postToDisplay = 1 ) {
  global $xml; // SimpleXMLElement
  $postToDisplay = 
  get_stored_parameter('post_number_to_display');
  $query = '(/rss/channel/item)[position() = %d]';
  // http://php.net/manual/en/function.sprintf.php
  return $xml->xpath(sprintf($query,$postToDisplay));
}

function blog_subtitle( $params = '' ) {
  global $xml; // SimpleXMLElement
  $results = $xml->xpath('/rss/channel[1]/description');
  if( count($results) == 1 && (count($results[0])==0) ) {
    // then assign the single result to the variable name
    return trim((string) $results[0]);
  } 
  // otherwise, return default
  return $params;
}

function blog_title( $params = '' ) {
  global $xml; // SimpleXMLObject
  $results = $xml->xpath('/rss/channel[1]/title');
  if( count($results) == 1 && (count($results[0])==0) ) {
    // then assign the single result to the variable name
    return trim((string) $results[0]);
  } 
  // otherwise, return default
  return $params;
}

// note: if this code is ran more than once, then we are computing
// things needlessly
function url_base( $params = '' ) {

  // get the url this page was requested with
  // strip out the GET parameters and save things before '?'
  // http://php.net/manual/en/reserved.variables.server.php
  // http://php.net/manual/en/function.strtok.php
  return strtok($_SERVER['REQUEST_URI'], '?');
}

function url_previous_post( $params = '' ) {
  $post_number_to_display =
  get_stored_parameter('post_number_to_display');
  $url = url_base() . '?post_number=';
  if( $post_number_to_display < 2 ) {
    // indicate to the view that there is not a previous post 
    return ''; 
  } 
  return $url . ($post_number_to_display-1);
}

function num_posts_available( $params = '' ) {
  global $xml; 
  return count($xml->xpath('/rss/channel/item'));
}

function url_next_post( $params = '' ) {
  $post_number_to_display =
  get_stored_parameter('post_number_to_display');
  $num_posts_available = 
  get_stored_parameter('num_posts_available');
  $url = url_base() . '?post_number=';
  if( $post_number_to_display >= $num_posts_available) {
    // indicate to the view that there is not a next post 
    return ''; 
  } else {
    return $url . ($post_number_to_display+1);
  }
}

// this function provides read-only access to a parameter already
// stored in in $data.
// note the sloppy scoping here with the global keyword 
// - this shows the need for OOP
// this would be a logical place to implement backup defaults
function get_stored_parameter( $param_name ) {
  global $data;
  // initialize if necessary
  if( (! isset($data[$param_name])) && is_callable($param_name) ) {
    $data[$param_name] = call_user_func($param_name);
  }
  return $data[$param_name];
}

// note - this is inefficient, we check each query term instead
// of just the ones we want. instead, we should use 
// http://www.php.net/manual/en/function.array-intersect-key.php
foreach( $data as $query_name => $query_param ) {
  if(function_exists($query_name)){
    // http://www.php.net/manual/en/function.call-user-func.php
    $data[$query_name] = call_user_func($query_name,$query_param);
  }
}

//  $data variable will now be returned (to the controller) with
//  the requested data filled in where possible 


