/** see douglas crockford's javascript: the good parts
 *  2008
 *  page 22
 ***/
if(typeof Object.create !== 'function') {
	Object.create = function(o) {
		var F = function() {};
		F.prototype = o;
		return new F();
	};
}

/**
 * simple object template from 
 * http://stackoverflow.com/questions/1114024/constructors-in-javascript-objects
 * See Douglas Crockford's
 * Javascript: The Good Parts for more info on 
 * Object Oriented Javascript
 **/ 
var Map = (function () {

	// private static 
    var nextId = 1;

    // constructor
    var cls = function (theUrl, defaultTile, idName) {

		if (typeof theUrl != 'string') 
			throw 'Name must be a string';
		if (theUrl.length < 2 ) 
			throw 'Name must be more than 2 characters.';
		// etc validation

        // private (this instance only)
        var id = nextId++; // nextId will be incremented
		var url = theUrl;
		var tile = defaultTile;
		// default
		var divId = idName || 'theMap';

		this.setTile = function( aTileObject ) {
			tile = aTileObject;
		};

		this.getDivId = function() {
			return divId;
		}

		this.setDivId = function( newDivId ) {
			divId = newDivId;	
		};

		this.getTile = function() {
			return tile;
		};

		this.getUrl = function() {
			return url;
		};
		
    };

    // public static
    cls.get_nextId = function () {
        return nextId;
    };

    // public static
	cls.getJSON = function( url, callback ) {
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				// see http://stackoverflow.com/questions/945015/alternatives-to-javascript-eval-for-parsing-json
				var json = eval("(" 
						+ xmlhttp.responseText + ")");
				callback(json);
			}
		}
		xmlhttp.open("GET",url,true);
		// set the request header so PHP can 
		// detect that the request is coming 
		// from ajax - libraries do this automatically
		xmlhttp.setRequestHeader("X-Requested-With", 
				"XMLHttpRequest");
		xmlhttp.send();
	}

	// public (shared across instances)
	cls.prototype = {
		announce: function () {
		  alert('Hi there! My id is ' 
			+this.get_id() 
			+' and my url is "' 
			+this.getUrl() + '"!\r\n' 
			+'The next Map\'s id will be ' 
			+Map.get_nextId() + '!');
        }, 
		loadNewTile : function( direction ) {
			var theUrl = this.getUrl();
			theUrl = theUrl + "?" 
				+ this.getQuery(direction);
			var that = this;
			Map.getJSON( theUrl, 
				function( tileJson ) {
					var newTile = new Tile( tileJson ); 			
					var oldTile = that.getTile();
					that.setTile( newTile );
					that.setImage( oldTile, newTile );
			}); 
	  	},
		getQuery : function(direction) {
			return this.getTile().getQuery() 
			+ "&" + direction + "=" + direction;
		},
		setImage: function( oldtile, newtile ) {
			var oldId = oldtile.getIdName(); 
			var newId = newtile.getIdName();
			var image = document.getElementById(oldId);
			image.src = newtile.getCacheName();
			image.id = newId;
		}
    };

    return cls;
}());

var Tile = (function () {

	// private static 
    var nextId = 1;
	var errStr = "To be valid, a Tile needs a ";

    // constructor
    var cls = function (paramJson) {
		
        // private (this instance only)
        var id = nextId++; // nextId will be incremented
		var cacheName = paramJson.cacheName;
		var zoom = paramJson.zoom;
		var lat = paramJson.lat;
		var lon = paramJson.lon;
		var x = paramJson.x;
		var y = paramJson.y;

		// validate constructor json arg
		if( typeof cacheName === "undefined" ) 
			throw errStr + "cacheName";
		if( typeof zoom === "undefined" ) 
			throw errStr + "zoom";
		if( typeof lat === "undefined" ) 
			throw errStr + "lat";
		if( typeof lon === "undefined" ) 
			throw errStr + "lon";
		if( typeof x === "undefined" ) 
			throw errStr + "xTile";
		if( typeof y === "undefined" ) 
			throw errStr + "y";

        // public (this instance only)
        this.get_id = function () { return id; };
        this.getCacheName = function () { return cacheName; };
        this.getZoom = function () { return zoom; };
        this.getLat = function () { return lat; };
        this.getLon = function () { return lon; };
        this.getX = function () { return x; };
        this.getY = function () { return y; };
		this.getIdName = function() {
			return "tile-"+x+"-"+y+"-"+zoom;
		};
    };

    // public static
    cls.get_nextId = function () {
        return nextId;
    };

    // public (shared across instances)
    cls.prototype = {
        announce: function () {
                alert('Hi there! My id is ' 
						+this.get_id() 
						+'\r\nThe next id will be ' 
					  	+Tile.get_nextId() + '!');
        }, 
		getQuery: function() {
			var str = 
				"zoom=" + this.getZoom() + "&" + 
				"x=" + this.getX() + "&" + 
				"y=" + this.getY(); 
			return str;
		}
    };

    return cls;
}());

