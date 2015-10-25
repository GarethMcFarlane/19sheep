$(window).load(function() {
	var result = [];
	var y = 0;
	var tmp;

	$('#output').each(function() {
		for (var i = 0; i < 7; i++) {
			result = $(this).find("td").eq(i).html();
			value = result.split(" ")[0];
			timestamp = result.split(" ")[1];
			y = i + 1;
			
			if (value == '01') {
				$('#r'+ y).css("background-color", "orange");
				$('#r'+ y+'> .tooltip').text("I don't feel good about my inner feelings.  " + "Submitted: " + timestamp);
			}
			if (value == '00') {
				$('#r'+ y).css("background-color", "violet");
				$('#r'+ y+'> .tooltip').text("I don't feel good about the outside world.  " + "Submitted: " + timestamp);
			}
			if (value == '11') {
				$('#r'+ y).css("background-color", "GreenYellow");
				$('#r'+ y+'> .tooltip').text("I feel good about my inner feelings.  " + "Submitted: " + timestamp);
			}
			if (value == '10') {
				$('#r'+ y).css("background-color", "#0D98BA");
				$('#r'+ y+'> .tooltip').text("I feel good about the outside world.  "+ "Submitted: " + timestamp);
			}
		}
	});
});

