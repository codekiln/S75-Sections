<?php 
//access the query to the model.
$xml = simplexml_load_file(M . "data.xml");

// $xml now has a SimpleXMLElement object in it
// that SimpleXMLElement has an xpath function
// that lets us render xpath queries on it. 
$data['query'] = $xml->xpath($data['query']);

//echo "<pre>";print_r( $data );echo "</pre>";

// $data variable will now be returned with the result of the
// query 
