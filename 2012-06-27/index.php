<?php
/**
  * File for displaying php examples for teaching
  * purposes. To display six examples (or however many)
  * put in a directory, create examples named 
  * prefix01.suffix to prefix06.suffix, then 
  * edit the call to getMaximumExampleNumber() and 
  * getExampleName() below to match your prefix
  * and suffix.
  * 
  * Author: Peter Nore
  * Created: July 20, 2011
  **/ 
require('handy.php');

$state = new PageState();
// get the number of examples in the current directory
$maxFnumber = getMaximumExampleNumber();


/**
  * Searches the given directory for files with names like
  * 'examplePrefix01.exampleSuffix, examplePrefix02.exampleSuffix'
  * etc. Default is "example01.php", "example02.php". Returns
  * the maximum example number for the given prefix and suffix
  * in the directory, and false if there is a problem reading the dir.
  */
function getMaximumExampleNumber($directory='.', $examplePrefix='example', $exampleSuffix='php') {
    $maxFnumber = 0;
   if( $handle = opendir($directory)) {
      while( false !== ($file = readdir($handle))) {
         if( preg_match( "/.*" . $examplePrefix . "\d\d\.$exampleSuffix/", $file ) ) {
            $num = intval(preg_replace( 
                     "/.*" . $examplePrefix . "(\\d+).*$exampleSuffix/", 
                     "\\1", $file ));
            $maxFnumber = max($num,$maxFnumber);
         }
      }
      closedir($handle);
      return $maxFnumber;
   }
   return false;
}

function getExampleName($index=1, $examplePrefix='example', $exampleSuffix='php') {
   return $examplePrefix . sprintf("%02d", $index) . "." .  $exampleSuffix; 
}

/**
  * Maintains page state
  **/
class PageState {

   public $query;
   public $data;
   public $file;

   function __construct() {
      // get the query string this page was requested with
      $this->query = $_SERVER['QUERY_STRING'];
      // put the values of the query into the data array
      parse_str($this->query, $this->data);
      // get this file and prevent xss; we're going to be
      // echoing this out to the user when we create links
      // to this file
      $this->file = htmlspecialchars($_SERVER['PHP_SELF']);
   }


   /**
    * $iframeOrSource is the string 'iframe' or 'source'. 
    * $controlNumber is the number of the iframe or source to query
    * returns the url that this page was requested with, except with 
    * the given $iframeOrSource $controlNumber combination toggled
    * the other direction.
    */
   function toggleParameter( $iframeOrSource, $controlNumber ) {
      if(! ($iframeOrSource=='iframes'||$iframeOrSource=='sources')) return;
      if( $this->isEnabled( $iframeOrSource, $controlNumber ) ) {
         unset( $this->data[$iframeOrSource][$controlNumber]);
      } else {
         $this->data[$iframeOrSource][$controlNumber]='?';  
      }
   }

   function getQuery() {
      $quer = http_build_query(
         array(
            'iframes'=>$this->data['iframes'],
            'sources'=>$this->data['sources'])) ; 
      return  $this->file . "?" . trim($quer);
   }

   /**
    * $iframeOrSource is the string 'iframe' or 'source'. 
    * $controlNumber is the number of the iframe or source to query
    * returns true iff the $iframeOrSource $controlNumber is activated
    * in the url that fetched this page.
    */
   function isEnabled( $iframeOrSource, $controlNumber ) {
      if(! ($iframeOrSource=='iframes'||$iframeOrSource=='sources')){ 
         return false;
      }
      $exists = array_key_exists( $controlNumber, $this->data[$iframeOrSource]);
      return $exists; 
   }

   function getToggleQuery( $iframeOrSource, $controlNumber ) {
      $this->toggleParameter($iframeOrSource, $controlNumber);
      $quer = $this->getQuery();
      $this->toggleParameter($iframeOrSource, $controlNumber);
      return $quer;
   }

   function getFile() {
      return $this->file;
   }

   function getIframe($number) {
      if( $this->isEnabled('iframes',$number ) ) {
         return $this->data['iframes'][$number];
      }
      return false;
   }
}

?>
<html>
  <head>
    <title>Examples</title>
   <link rel="stylesheet" type="text/css" href="index_style.css"/>
  </head>
  <body>
   <h1>Examples</h1>
   <h2>HTTP, DNS, GET, POST, SESSION</h2>
   <h2><a
   href="http://prezi.com/j6oeo9karhiw/s75-section-2012-06-27-wed/">presentation
   slideshow</a></h2>
   <? //printGet(); ?>
   <table border="1">
   <?php 
      for( $i=1; $i <= $maxFnumber; $i++ ){
         $fname = getExampleName($i);
         $rowId = "example-$i";
         $hasSource = $state->isEnabled('sources', $i);
         $iframe = $state->getIframe($i);
         ?>
         <tr id="<?=$rowId?>">
         <td><?=$fname?></td>
         <td><a target='blank' href='<?= $fname?>'>new tab</a></td>
         <td>
         <!-- for later: 
              onclick="window.frames['<?=$fname?>']
              .location='<?=$fname?>'; return false;"
           -->
         <a href='<?=$state->getToggleQuery('sources',$i).'#'.$rowId."'>";
         echo ($hasSource)? "hide src" : "show src";  
         echo "</a><pre ";
         echo ($hasSource)? ">" : " style='display:none'>";
         echo htmlspecialchars(file_get_contents($fname)) ;
         ?>
            </pre>
          </td>
         <td>
            <a href='<?php 
            echo $state->getToggleQuery('iframes', $i).'#'.$rowId."'>";
            echo ($iframe) ? "hide" : "show";
            echo "</a>";
            if($iframe) { ?>
         <!--     <form action="<?=$state->getQuery().'#'.$rowId?>" method="get">
                  query parameters: <input type="text" name="iframes[<?=$i?>]" value="<?=$iframe?>"/>
               </form>-->
               <iframe 
                    <?php if($iframe) echo 'style="width:500px;height:500px;"';?>
                    src='<?=$fname . $iframe?>' name='<?=$fname?>'>
                  <p>Your browser does not support iframes.</p>
               </iframe>
            <? } ?>
         </td>
      <?}?>
  </body>
</html>
