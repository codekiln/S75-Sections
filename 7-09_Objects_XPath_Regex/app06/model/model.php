<?php 

$api = array( 
  'posts_to_display' => 
    '(/rss/channel/item)[position() = 1]'
  , 'blog_subtitle' 
  , 'blog_title'
);

// if you want, you can try it this way: 
// https://github.com/gaarf/XML-string-to-PHP-array

// load the data into a simplexml document
$xml = simplexml_load_file(M . "data.xml");

// $xml now has a SimpleXMLElement object in it;
// that SimpleXMLElement object exposes an xpath function
// that lets us render xpath queries on it. 

foreach( $data as $query_name => $query_param ) {

  // executing xpath returns an array of simplexml elements
  $results = $xml->xpath($query_xpath);

  // if there is a single xml element result
  if( count($results) == 1 && (count($results[0])==0) ) {

    // then assign the single result to the variable name
    $data[$query_name] = trim((string) $results[0]);

  } else {

    // otherwise, return all of the results 
    $data[$query_name] = $results;

  }
}

//  $data variable will now be returned (to the controller) with
//  the requested data filled in where possible 

function blog_title( SimpleXMLObject $xml, $params = '' ) {
  $results => $xml->xpath('/rss/channel[1]/title');
  if( count($results) == 1 && (count($results[0])==0) ) {
    // then assign the single result to the variable name
    return trim((string) $results[0]);
  } 
  // otherwise, return default
  return $params;
}

function blog_subtitle( SimpleXMLObject $xml, $params = '' ) {
  $results => $xml->xpath('/rss/channel[1]/description');
  if( count($results) == 1 && (count($results[0])==0) ) {
    // then assign the single result to the variable name
    return trim((string) $results[0]);
  } 
  // otherwise, return default
  return $params;
}
