// main.js  - with jquery

/**
This script makes the nested lists created by PHP File Tree
expand and collapse dynamically.

Requires jQuery. 

@author http://goo.gl/Ft7m5 
**/
$(document).ready( function() {
    
    // Hide all subfolders at startup
    $(".php-file-tree").find("UL").hide();
    
    // Expand/collapse on click
    $(".pft-directory A").click( function() {
        $(this).parent().find("UL:first").slideToggle("medium");
        if( $(this).parent().attr('className') == "pft-directory" ) return false;
    });

});
