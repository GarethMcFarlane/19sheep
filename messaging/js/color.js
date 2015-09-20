$(document).ready(function() {

	$('#m1').change(function(event) {
		if ($(this).prop('checked')) {
			document.getElementById("tri1").style.boxShadow = "0 0 0 3px white, 0 0 0 5px green";
			document.getElementById("tri2").style.boxShadow = "none";
		}
	});
	$('#m2').change(function(event) {
		if ($(this).prop('checked')) {
			document.getElementById("tri2").style.boxShadow = "0 0 0 3px white, 0 0 0 5px red";
			document.getElementById("tri1").style.boxShadow = "none";
		}
	});
	$('#m3').change(function(event) {
		if ($(this).prop('checked')) {
			document.getElementById("tri3").style.boxShadow = "0 0 0 3px white, 0 0 0 5px yellow";
			document.getElementById("tri4").style.boxShadow = "none";
		}
	});
	$('#m4').change(function(event) {
		if ($(this).prop('checked')) {
			document.getElementById("tri4").style.boxShadow = "0 0 0 3px white, 0 0 0 5px blue";
			document.getElementById("tri3").style.boxShadow = "none";
		}
	});

});
