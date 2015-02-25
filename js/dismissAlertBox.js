// Set a cookie to prevent this from showing again...
jQuery(document).ready( function() {

	jQuery("#homeMessage #home-close-icon").click( function() {

		var alertSiteID = jQuery(this).parent().attr("data-site-id");
		var alertID = jQuery(this).parent().attr("data-alert-id");
		
		if ( getCookie( "dismissAlertBoxSet" + alertSiteID + "-" + alertID ) !== "true") {

			// Dismiss alert box...
			jQuery(this).parent().hide(function() {
				jQuery(this).remove();
				document.cookie = "dismissAlertBoxSet" + alertSiteID + "-" + alertID + "=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
			});

		}
		else {
			jQuery(this).parent().hide(function() {
				jQuery(this).remove();
			});
		}
				
	});
	
});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    
    for( var i=0; i < ca.length; i++ ) {
	    
        var c = ca[i];
        while (c.charAt(0)==' ') {
	        c = c.substring(1);
		}
        
        if (c.indexOf(name) == 0) {
			return c.substring(name.length,c.length);
		}
    }
    
    return "";
}