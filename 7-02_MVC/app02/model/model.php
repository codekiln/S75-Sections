<?php 
//access the query to the model.
$xml = simplexml_load_file(M . "data.xml");
// $xml now has a SimpleXMLElement object in it
// that object has an xpath method
$data['result'] = $xml->xpath($data['query']);
//echo "<pre>";print_r( $data );echo "</pre>";
// $data variable will now be returned result and query intact
