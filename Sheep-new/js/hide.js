$(document).ready(function() {
	$('#tut_link').click(function() {
		if ($('.tut_video').hasClass("hidden")) {
			$('.tut_video').removeClass("hidden").addClass("visible");
		} else {
			$('.tut_video').removeClass("visible").addClass("hidden");
		}
	});
	$('#hide-btn').click(function() {
		if ($('.tut_video').hasClass("hidden")) {
			$('.tut_video').removeClass("hidden").addClass("visible");
		} else {
			$('.tut_video').removeClass("visible").addClass("hidden");
		}
	});
});