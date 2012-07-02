<?php 
//access the query to the model.
$xml = simplexml_load_file(M . "data.xml");

// $xml now has a SimpleXMLElement object in it
// that SimpleXMLElement has an xpath function
// that lets us render xpath queries on it. 

// NEW: lets make it so that we can support multiple queries from
// the controller all at once. 
foreach( $data as $variable_name => $xpath ) {
    $data["$variable_name"] = $xml->xpath($xpath);
}


//  $data variable will now be returned (to the controller) 
//  with the result of EACH query stored in the specified 
//  variable name
