// Document Ready Event
$(document).ready(function() {
    
    // Join our List button event
	$("#join_list").click(function() {
            // https://www.w3schools.com/jquery/html_val.asp
            var emailAddress1 = $("#email_address1").val();
			var emailAddress2 = $("#email_address2").val();
			var isValid = true;
			
			// validate the first email address
			if (emailAddress1 == "") { 
				// https://www.w3schools.com/jquery/traversing_next.asp
				// https://www.w3schools.com/jquery/html_text.asp
				$("#email_address1").next().text("This field is required.");
				isValid = false;
			} else {
				$("#email_address1").next().text("");
			} 
			
			// validate the second email address
			if (emailAddress2 == "") { 
				$("#email_address2").next().text("This field is required.");
     				isValid = false; 
			} else if (emailAddress1 !== emailAddress2) { 
				$("#email_address2").next().text("The email address entered must be the same.");
				isValid = false;
			} else {
				$("#email_address2").next().text("");
			}
			
			// validate the first name entry  
			if ($("#first_name").val() == "") {
				$("#first_name").next().text("This field is required.");
				isValid = false;
			} 
			else {
				$("#first_name").next().text("");
			}
			
			// submit the form if all entries are valid
			if (isValid) {
				// https://www.w3schools.com/jquery/event_submit.asp
				$("#email_form").submit(); 
			}
	});	// end click
	
        //Additional enhancement
		// https://www.w3schools.com/jquery/event_focus.asp
        $("#email_address1").focus(function(){
			// https://stackoverflow.com/questions/12481439/jquery-this-keyword
			// https://www.w3schools.com/jquery/jquery_css.asp
          $(this).css("background-color","#FFF8C6");  
        });
		// https://www.w3schools.com/jquery/event_blur.asp
        $("#email_address1").blur(function(){
          $(this).css("background-color","#FFFFFF");  
        });
        
        $("#email_address2").focus(function(){
          $(this).css("background-color","#FFF8C6");  
        });
        $("#email_address2").blur(function(){
          $(this).css("background-color","#FFFFFF");  
        });
        
        $("#first_name").focus(function(){
          $(this).css("background-color","#FFF8C6");  
        });
        $("#first_name").blur(function(){
          $(this).css("background-color","#FFFFFF");  
        });
            

        // Clear entries button event
	$("#clear_entries").click(function() {
		// https://stackoverflow.com/questions/10552838/whats-the-purpose-of-a-leading-colon-in-a-jquery-selector
		$(":text").val("");
		$(":text").next().text("*");
		$("#email_address1").focus();
	});	// end click
	
    // https://www.w3schools.com/jquery/event_dblclick.asp    
	$(":text").dblclick(function() {
		 //$("#clear_entries").click();
		$(this).val("");
	});

        // Additional enhancement
	$("#email_address1").focus();
}); // end ready
