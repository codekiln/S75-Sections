<?php
class Map12 {

	function __construct() {
		global $queryUrl, $zoom, $lat, $lon, $xTile, 
			   $yTile, $cacheName, $fname, $fnumber;
		// get the GET parameters
		// default: ?zoom=15&lat=42.37447&lon=-71.11952
		$queryUrl ="http://www.opencyclemap.org/search.php?q=";
		$zoom = (isset($_GET['zoom'])) ? 
            $_GET['zoom'] : 15; 
		$lat = (isset($_GET['lat'])) ? 
            $_GET['lat'] : 42.37447; 
		$lon = (isset($_GET['lon'])) ? 
            $_GET['lon'] : -71.11952; 
		$xTile = $this->getXTile( $lat, $lon, $zoom );
		$yTile = $this->getYTile( $lat, $lon, $zoom );
		$xTile = (isset($_GET['x'])) ? 
            $_GET['x'] : $xTile; 
		$yTile = (isset($_GET['y'])) ? 
            $_GET['y'] : $yTile; 
        if( isset( $_GET['north'] ) ) {
            $yTile--;
        }
        if( isset( $_GET['south'] ) ) {
            $yTile++;
        }
        if( isset( $_GET['west'] ) ) {
            $xTile--;
        }
        if( isset( $_GET['east'] ) ) {
            $xTile++;
        }
		$cacheName = $this->getCachedFname(
            $xTile, $yTile, $zoom);
	}

	/**
	 * returns the openstreetmap xtile number, given the 
	 * latitude, longitude, and zoom
	 */
	function getXTile( $lat, $lon, $zoom ) {
		return floor((($lon + 180) / 360) * pow(2, $zoom));
	}

	/**
	 * returns the openstreetmap ytile number, given the
	 * latitude, longitude, and zoom
	 */
	function getYTile( $lat, $lon, $zoom ) {
		return floor((1 - log(tan(deg2rad($lat)) + 1 / 
        cos(deg2rad($lat))) / pi()) /2 * pow(2, $zoom));
	}

    /** * if the image for $xtile, $ytile, $zoom is cached,
    returns * the filename of the cached image. if it is not
    cached, * fetches and caches the given image from
    opencyclemap.  */
	function getCachedFname( $xtile, $ytile, $zoom ) {
		$remoteImageFilename = 
			"http://a.tile.opencyclemap.org/cycle/"
            . "$zoom/$xtile/$ytile.png";
		// strip away everything except for 
        // the /14/4944/6053
		$localImageFilename = preg_replace(
	        "/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/",
            "\\4",  // save the fourth capture grp
	        $remoteImageFilename);
		// replace the forward slash '/' with underscore '_'
		$localImageFilename = preg_replace("/\//","_",
				$localImageFilename);
		$localImageDirectory = "images";
		$cacheName = 
			$localImageDirectory . "/" 
            . $localImageFilename . ".png";
		// go get the remote image only if it's not 
        // in the cache and check to make sure it is 
        // strictly equal to false (===)
		if(file_exists($cacheName)===false){
			$image = 
              file_get_contents($remoteImageFilename); 
			file_put_contents($cacheName, $image);
			// you need to set the permissions manually
			chmod($cacheName,644);
		} 
		return $cacheName;
	}

	function getHeader($insert = "") {
        global $fnumber, $purpose;
		$header = "<!DOCTYPE HTML>
			<html>
	    		<head>
	        		<title>map$fnumber.php</title>
                    $insert
		    	</head>
                <body>
                    <p>$purpose</p>
                    <div id=\"example\">
        ";
        return $header;
	}

    function getFooter() {
        global $exampleParams, $fname;
        $footer = "";
        if( $exampleParams != "" ) {
            $footer .= "<p>
                    Example parameters: 
                    <a href=\"$fname.$exampleParams\">
                    $exampleParams</a>
                    </p>
            ";
        }
        printGet();
        return  $footer . $this->getParamHtml() 
        . "
                    </div><!-- end of example div -->
                </body>
            </html>
        ";
    }

    function getParamHtml() {
        global $cacheName, $zoom, $lat, $lon, $xTile,
           $yTile; 
        $vars = "";
        /*
        NOTE - you shouldn't echo submitted
        parameters without htmlspecialchars in
        production code because of XSS risk.  it
        is probably fine without it here for
        example purposes. 
        */
        $vars.="<br/><b>cacheName: </b>$cacheName"; 
        $vars.="<br/><b>zoom:</b>$zoom"; 
        $vars.="<br/><b>lat:</b>$lat"; 
        $vars.="<br/><b>lon:</b>$lon"; 
        $vars.="<br/><b>lon:</b>$lon"; 
        $vars.="<br/><b>xTile:</b>$xTile"; 
        $vars.="<br/><b>yTile:</b>$yTile"; 
        return $vars; 
    }

    function getRequiredHiddenInputs() {
        global $zoom, $xTile, $yTile;
        return "
        <input type=\"hidden\" 
            name=\"zoom\" value=\"$zoom\"/>
        <input type=\"hidden\" 
            name=\"x\" value=\"$xTile\"/>
        <input type=\"hidden\" 
            name=\"y\" value=\"$yTile\"/>
        ";
    }

	function getNavigation() {
		global $fname;
		$navigation = "
			<form action='$fname' method='get'>
			<input type='submit' name='north' 
				value='North'/>
			<input type='submit' name='west' 
				value='West'/>
			<input type='submit' name='east' 
				value='East'/>
			<input type='submit' name='south' 
				value='South'/>";
		$navigation .= $this->getRequiredHiddenInputs();
		$navigation .= "</form>";
		return $navigation;
	}

	function getImage() {
		global $cacheName, $lat, $lon, $zoom;
		return "<img src='$cacheName' 
			alt='cycle map of latitude $lat, 
			longitude $lon, and zoom $zoom' />";
	}

}
