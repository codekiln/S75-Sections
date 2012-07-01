<?php
/**
  * File for displaying php examples for teaching
  * purposes. To display six examples (or however many)
  * put in a directory, create examples named 
  * prefix01.suffix to prefix06.suffix, then 
  * edit the call to getMaxExampleNum() and 
  * getExampleFilename() below to match your prefix
  * and suffix.
  * 
  * Author: Peter Nore
  * Created: July 20, 2011
  **/ 

/** class ExampleDataManager  {{{
  * 
  * Stores information about examples in the same directory as
  * this file and maintains the state of individual toggleable
  * cells for each example in index.php using GET parameters. 
  ***/
class ExampleDataManager {

    /**
      the GET query this page was fetched with
     **/
    public $query; // the GET query this page was fetched with

    /**
      array that stores state information about each example, such as
      which examples have visibly open iframes or visible source
      code.
     **/
    public $data;

    /**
      the name of the file that houses this code - this will be
      echoed out to the screen
     **/
    public $file;

    /**
      the name of the folder that these examples are stored in
    **/
    public $parentFolderName;

    function __construct() {
        // get the query string this page was requested with
        $this->query = $_SERVER['QUERY_STRING'];
        // put the values of the query into the data array
        parse_str($this->query, $this->data);

        // get this file and prevent xss; we're going to be
        // echoing this out to the user when we create links
        // to this file
        $this->file = htmlspecialchars($_SERVER['PHP_SELF']);

        $this->parentFolderName = basename(dirname($this->file));
    }

    /**
      Takes some parameters that describe a predictably named file,
      and returns a string of the predictable file name.

      $index - the index of the example; example05.php would be index 5
      $examplePrefix - in 'example05.php', 'example' is the prefix
      $exampleSuffix - in 'example05.php', 'php' is the suffix
     */
    function getExampleFilename(
            $index=1, $examplePrefix='example', $exampleSuffix='php') {
        return $examplePrefix . sprintf("%02d", $index) . "." .
            $exampleSuffix; 
    }

    /**
     * Searches the given directory for files with names like
     * 'examplePrefix01.exampleSuffix. Default is like
     * "example01.php", "example02.php". Returns the maximum
     * example number present in the same directory as this file, 
     * for the given prefix and suffix. Returns false if there is a
     * problem reading the directory.
     */
    function getMaxExampleNum(
            $directory='.',
            $examplePrefix='example', 
            $exampleSuffix='php') {
        $maxFnumber = 0;
        if( $handle = opendir($directory)) {
            while( false !== ($file = readdir($handle))) {
                if( preg_match( 
                            "/.*" . $examplePrefix .
                            "\d\d\.$exampleSuffix/", 
                            $file ) 
                  ) {
                    $num = intval( preg_replace( 
                                "/.*" . $examplePrefix .
                                "(\\d+).*$exampleSuffix/", 
                                "\\1", $file ));
                    $maxFnumber = max($num,$maxFnumber);
                }
            }
            closedir($handle);
            return $maxFnumber;
        }
        return false;
    }

    /**
     * Handy print array function for debugging
     */
    function pr($arr) {
        echo '<pre>', htmlspecialchars(print_r($arr, true)), "</pre>\n";
    }

    /**
     * Handy function that will print the GET params
     * if there are any
     */
    function printGet() {
        if( count($_GET) > 0 ) {
            echo "<h2>Query: ?" . $_SERVER['QUERY_STRING'] . "</h2>";
            pr( $_GET );
        }
    }

    /**
     * Returns the url the page was requested with, except with 
     * the given $iframeOrSource $controlNumber combination toggled
     * the other direction.

     * $iframeOrSource - the string 'iframe' or 'source'. 
     * $controlNumber - the number of the iframe or source to query
     */
    function toggleParameter( $iframeOrSource, $controlNumber ) {
        if(! ($iframeOrSource=='iframes'||$iframeOrSource=='sources')) return;
        if( $this->isEnabled( $iframeOrSource, $controlNumber ) ) {
            unset( $this->data[$iframeOrSource][$controlNumber]);
        } else {
            $this->data[$iframeOrSource][$controlNumber]='?';	
        }
    }

    /**
      Builds the query to fetch the version of the example page that
      reflects the internal state stored in $data. 
     **/
    function getQuery() {
        $quer = http_build_query(
                array(
                    'iframes'=>@$this->data['iframes'],
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
        $exists = (@$this->data[$iframeOrSource]) 
            ? array_key_exists( $controlNumber, @$this->data[$iframeOrSource])
            : false;
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
}// end of ExampleDataManager }}} 


$examples = new ExampleDataManager();

?>
<html>
  <head>
    <title><?php echo $examples->parentFolderName?></title>
  </head>
  <body>
  	<h1><?php echo $examples->parentFolderName ?></h1>
	<? //printGet(); ?>
	<table border="1">
	<?php 
		for( $i=1; $i <= $examples->getMaxExampleNum(); $i++ ){
			$fname = $examples->getExampleFilename($i);
			$rowId = "example-$i";
			$hasSource = $examples->isEnabled('sources', $i);
			$iframe = $examples->getIframe($i);
			?>
			<tr id="<?=$rowId?>">
			<td><?=$fname?></td>
			<td><a target='blank' href='<?= $fname?>'>new tab</a></td>
			<td>
			<!-- for later: 
				  onclick="window.frames['<?=$fname?>']
				  .location='<?=$fname?>'; return false;"
			  -->
			<a href='<?=$examples->getToggleQuery('sources',$i).'#'.$rowId."'>";
			echo ($hasSource)? "hide src" : "show src";	
			echo "</a><pre ";
			echo ($hasSource)? ">" : " style='display:none'>";
			echo htmlspecialchars(file_get_contents($fname)) ;
			?>
				</pre>
		    </td>
			<td>
				<a href='<?php 
				echo $examples->getToggleQuery('iframes', $i).'#'.$rowId."'>";
				echo ($iframe) ? "hide" : "show";
				echo "</a>";
				if($iframe) { ?>
					<!--<form action="<?=$examples->getQuery().'#'.$rowId?>" method="get">
						query parameters: <input type="text" name="iframes[<?=$i?>]" value="<?=$iframe?>"/>
					</form>-->
					<iframe style="width:500px;height:500px;" src='<?=$fname . $iframe?>' name='<?=$fname?>'>
						<p>Your browser does not support iframes.</p>
					</iframe>
				<? } ?>
			</td>
		<?}?>
  </body>
</html>
