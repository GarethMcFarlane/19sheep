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
	$('.showdiv-l-2').click(function() {
		
		if ($('.hidden-div-l-2').hasClass("hidden")) {
			$('.hidden-div-l-2').removeClass("hidden").addClass("visible");
		} else {
			$('.hidden-div-l-2').removeClass("visible").addClass("hidden");
		}
	});
	$('.showdiv-r-2').click(function() {
		
		if ($('.hidden-div-r-2').hasClass("hidden")) {
			$('.hidden-div-r-2').removeClass("hidden").addClass("visible");
		} else {
			$('.hidden-div-r-2').removeClass("visible").addClass("hidden");
		}
	});
	
}); 