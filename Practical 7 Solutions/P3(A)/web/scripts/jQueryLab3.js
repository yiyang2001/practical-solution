$(document).ready(function() {
	// https://www.w3schools.com/jquery/jquery_ref_selectors.asp
	// https://www.w3schools.com/jquery/misc_each.asp
	$("#image_rollovers img").each(function() {
		// get old and new urls
		var oldURL = $(this).attr("src");
		var newURL = $(this).attr("id");
		
				
		// set up event handlers
		// https://www.w3schools.com/jquery/event_mouseover.asp			
		$(this).mouseover(function() {
				// https://www.w3schools.com/jquery/html_attr.asp
				$(this).attr("src", newURL);
		});// end mouseover
		
		// https://www.w3schools.com/jquery/event_mouseout.asp
		$(this).mouseout(function() {
				$(this).attr("src", oldURL);
		}); // end mouseout
		
/*		// set up event handlers			
		$(this).hover(
			function() {
				$(this).attr("src", newURL);
			},
			function() {
				$(this).attr("src", oldURL);
			}
		); // end hover
*/
	}); // end each
}); // end ready