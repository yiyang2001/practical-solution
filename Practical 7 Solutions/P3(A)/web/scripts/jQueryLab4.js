$(document).ready(function() {
        //select the first image element
		// https://www.w3schools.com/jquery/jquery_ref_selectors.asp
	var nextSlide = $("#slides img:first-child");
	var nextCaption;
	var nextSlideSource;
		
	// Start slide show
	// https://www.w3schools.com/jsref/met_win_setinterval.asp
    timer1 = setInterval(
        function () {
			// https://www.w3schools.com/jquery/eff_hide.asp
        	$("#caption").hide(1000);   
        	$("#slide").slideUp(2000,
                
                //callback function
           		function () {
					// https://stackoverflow.com/questions/7678499/jquery-checking-if-next-element-exists
           	     	if (nextSlide.next().length == 0) {
						nextSlide = $("#slides img:first-child");
					}
					else {
						nextSlide = nextSlide.next();
					}
					nextSlideSource = nextSlide.attr("src");
					nextCaption = nextSlide.attr("alt");
					// https://www.w3schools.com/jquery/eff_show.asp
					$("#caption").text(nextCaption).show(1000);
					$("#slide").attr("src", nextSlideSource).slideDown(2000);					
				}
			)
		}, 
		5000
	);
})