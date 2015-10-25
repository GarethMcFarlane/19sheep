var commitCounter=0;
var length = 0;
var currentStyle;
var startul = '';
var endul = '';

var finalHTML = '';

//Jquery Ajax
var commitments_data;

$.ajax({
    type: 'POST',
    url: 'getcommitments.php',
    async: false,
    data: {test: '1'},
    dataType: 'text',
    success: function(response){
      commitments_data = JSON.parse(response);
    }
  });  



function determineColour(type) {
	switch(type) {
		case "Intense Activity":
			return "DarkBlue";
			break;
		case "Medium Activity":
			return "blue";
			break;
		case "Light Activity":
			return "lightBlue";
			break;
		case "Steps":
			return "yellow";
			break;
		case "Weight":
			return "Orange";
			break;
		case "Blood Pressure":
			return "red";
			break;
		case "Total Sleep":
			return "green";
			break;
		case "Wake-ups":
			return "darkGreen";
			break;
		case "Evening Sleep":
			return "lightGreen";
			break;
		case "Morning Sleep":
			return "lawnGreen";
			break;
		case "Sleep Score":
			return "turquoise";
			break;
	}
}

function formatDate (day, month, year) {
	switch(month) {
		case "Jan":
		return day.concat('-01-', year);
		break;
		
		case "Feb":
		return day.concat('-02-', year);
		break;
		
		case "Mar":
		return day.concat('-03-', year);
		break;
		
		case "Apr":
		return day.concat('-04-', year);
		break;
		
		case "May":
		return day.concat('-05-', year);
		break;
		
		case "Jun":
		return day.concat('-06-', year);
		break;
		
		case "Jul":
		return day.concat('-07-', year);
		break;
		
		case "Aug":
		return day.concat('-08-', year);
		break;
		
		case "Sep":
		return day.concat('-09-', year);
		break;
		
		case "Oct":
		return day.concat('-10-', year);
		break;
		
		case "Nov":
		return day.concat('-11-', year);
		break;
		
		case "Dec":
		return day.concat('-12-', year);
		break;
	}
	return;
}

$(document).ready(function() {
	for (i = 0; i < commitments_data.length; ++i) {
			newCommitment(commitments_data[i]);
		}

	var commits = document.getElementById("commitDivs");
	commits.innerHTML = commits.innerHTML + finalHTML;
});

function newCommitment(commitments) {
	commitCounter++;
	if (commitCounter%2 != 0) {
		currentStyle = ' class="timeline-inverted"';
	} else {
		currentStyle = '';
	}


	//li
	var li1 = '<li';
	var li2 = '>';
	var li = li1.concat(currentStyle,li2);

	//First Div
	var treeDiv = '<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>';

	//Panel start
	var panel = '<div class="timeline-panel">';

	//Heading:
	var heading1 = '<div class="timeline-heading"><h4 class="timeline-title">';
	var heading2 = '</h4><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>';
	var heading3 = '</small></p></div>';
	var finalheading = heading1.concat(commitments.text, heading2, commitments.startday, heading3);


	//Body
	var body1 = '<div class="timeline-body"><p>';
	var body2 = '</p><div style="clear:both"><a href="commitments.php?complete='
	var body3 = '" class="btn btn-info btn-sm" role="button">Mark Complete</a></div>'
	var body4 = '</div></div></li>';
	var body = body1.concat('Target for this day: ', commitments.targetperday,body2,commitments.id, body3, body4);



	if (commitCounter == commitments_data.length) {
		startul = '<ul class="timeline">';
	} else {
		startul = '';
	}

	if (commitCounter == 1) {
		endul = '</ul>';
	} else {
		endul = '';
	}

	var finalDiv = '';
	finalDiv = finalDiv.concat(startul, li,treeDiv,panel,finalheading,body, endul);
	finalHTML = finalDiv + finalHTML;
	
	checkDate(commitments.startday, commitments.deadline);
}

function checkDate(dateMade, goalDate) {
	alert(dateMade);
	alert(goalDate);
	var duration = goalDate - dateMade;
	var timeLeft = goalDate - currentDate;
	alert(duration);
	if(timeLeft/duration == 0.5 || timeLeft == 7) {
		$('dateMessage').show();
		$(document.getElementById('dismiss').click(function(
			$('dateMessage').hide();
		));
	//UP TO HERE, DO TEST FOR TODAYS DATE
	}
	
	$(document.getElementById('dismiss').click(function(
		$('dateMessage').hide();
	));
}