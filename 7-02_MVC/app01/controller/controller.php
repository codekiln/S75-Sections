<?php 
/* right now, the site doesn't feature any interaction, so
 * this is going to be a really boring controller page. 
 */
$data = array( 'query' => '/rss/channel/item' );
// the data variable will be filled in the model according to the
// query
include(M . "model.php");


// now the $data var contains the query and the result
//  ... see?
//echo "<pre>"; print_r($data); echo "</pre>";
include(V . "view.php");
