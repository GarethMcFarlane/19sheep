var numb = [];

function randombtn() {
	numb = [];
	while (numb.length < 4) {
		var randomnumber = Math.floor(Math.random() * 37 + 1);
		var found = false;
		for (var j = 0; j < numb.length; j++) {
			if (numb[j] == randomnumber) {
				found = true;
				break;
			}
		}
		if (!found) {
			numb[numb.length] = randomnumber;
		}
	}
}

function showbtn() {
	for (var z = 0; z < 4; z++) {
		$('#btn-' + numb[z]).removeClass("hidden").addClass("visible");
	}
}

function hidebtn() {
	for (var i = 0; i < 4; i++) {
		$('#' + 'btn-' + numb[i]).removeClass("visible").addClass("hidden");
	}
}
randombtn();
showbtn();

window.setInterval(function() {
	hidebtn();
	randombtn();
	showbtn();
}, 8000);

$(document).ready(function() {
	$('#btn-refresh').click(function() {
		hidebtn();
		randombtn();
		showbtn();
	});
});
