$(document).ready(function() {
	$('.showdiv-l').click(function() {
		
		if ($('.hidden-div-l').hasClass("hidden")) {
			$('.hidden-div-l').removeClass("hidden").addClass("visible");
		} else {
			$('.hidden-div-l').removeClass("visible").addClass("hidden");
		}
	});
	$('.showdiv-r').click(function() {
		
		if ($('.hidden-div-r').hasClass("hidden")) {
			$('.hidden-div-r').removeClass("hidden").addClass("visible");
		} else {
			$('.hidden-div-r').removeClass("visible").addClass("hidden");
		}
	});
}); 