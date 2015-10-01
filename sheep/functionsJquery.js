var textCommit;
var commitCounter=0;
var realCommitCounter=0;
var SCompleteCounter=0;
var goalDate;
var commitType;
var commitSubType;
var target;

//var appearId;

var textCommit2;
var commitCounter2=0;
var realCommitCounter2=0;
var ACompleteCounter=0;

function showForm() {
	var list = document.getElementById('commitType');
	commitType=list.options[list.selectedIndex].text;
	$(document.getElementsByClassName('error')).hide();
	//clearAll();
	if(commitType.localeCompare("Activity") == 0) {
		$('#activityForm').show();
		$('#sleepForm').hide();
	} else {
		$('#sleepForm').show();
		$('#activityForm').hide();
		
	}
}

function clearAll() {
	document.getElementById('activityType').selectedIndex = 0;
	document.getElementById('activityTarget').value = ""/* click to enter */;
	document.getElementById('activityGDate').value = ""/* dd-mm-yyyy */;
	document.getElementById('activityCommit').value = ""/* Enter commitment... */;
	
	document.getElementById('sleepType').selectedIndex = 0;
	document.getElementById('sleepTarget').value = ""/* click to enter */;
	document.getElementById('sleepGDate').value = ""/* dd-mm-yyyy */;
	document.getElementById('sleepCommit').value = ""/* Enter commitment... */;
}

function hideForm() {
	if(commitType.localeCompare("Activity") == 0) {
		$('#activityForm').hide();
	} else if(commitType.localeCompare("Sleep") == 0) {
		$('#sleepForm').hide();
	}
	document.getElementById("commitType").selectedIndex = 0;
	$(document.getElementsByClassName('error')).hide();
}

function subSelected() {
	var list;
	
	if(commitType.localeCompare("Activity") == 0) {
		list = document.getElementById('activityType');
		commitSubType=list.options[list.selectedIndex].text;
	} else if(commitType.localeCompare("Sleep") == 0) {
		list = document.getElementById('sleepType');
		commitSubType=list.options[list.selectedIndex].text;
	}
}

function validateFields() {
	var isGood = true;
	
	var list = document.getElementById('Type');
	var subType=list.options[list.selectedIndex].text;
	//Making sure user has selected activity type
	if(subType.localeCompare("(please select a type)")==0) {
		isGood = false;
	}
	
	//Making sure use has entered a target
	var target = document.getElementById('Target').value;
	if(target.localeCompare("click to enter")==0 || !target) { //<<<<<<<<< do we need something written, what?
		isGood = false;
	}
	
	//if(validateDate()) {
		//DO SOMETHING FOR DATE
	//}
	
	//Making sure user has entered a commitment which is <100 chars long
	var commit = document.getElementById('Commit').value.toString();
	if(commit.localeCompare("Enter commitment...") == 0 || !commit) { //<<<<<<<<<<< Same for here
		document.getElementById('ACommitErr').innerHTML = "Please enter a commitment";
		isGood = false;
	} else if(commit.length >= 99) {
		document.getElementById('ACommitErr').innerHTML = "Please enter a commitment no more than 99 characters long";
		isGood = false;
	}
	
	return isGood;
}


function fieldsSelected() {
	var list;
	
		list = document.getElementById('Type');
		commitSubType=list.options[list.selectedIndex].text;
		document.getElementById('Type').selectedIndex = 0;
		
		target = document.getElementById('Target');
		document.getElementById('Target').value = ""; /* click to enter */
		
		goalDate = document.getElementById('GoalDate').value.toString();
		document.getElementById('GoalDate').value = ""; /* dd-mm-yyyy */
		
		textCommit = document.getElementById('Commit').value.toString();
		document.getElementById('Commit').value = "";/* Enter commitment... */
}

$(document).ready(function() {
	
	$("#submit").click(function() {	
		
		var fieldsValid = validateFields();
	
		if(fieldsValid == true) {
			fieldsSelected();
			newCommitment();
		}
	});
});



function determineColour() {
	switch(commitSubType) {
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

function newCommitment() {
	
	commitCounter++;
	realCommitCounter++;
	if(realCommitCounter >= 1) {
		$('#noneSubmit').hide();
	}

	//------------------TYPE-------------------
	
	//------------------DATE-------------------
	var currentDate = Date.now();

	//alert(Date(1442664635396 - (30*86400000)));
	
	var currentDateString = Date(currentDate).toString();
				
	var day = "";
	var	month = "";
	var year = "";
	var dateFormatted = "";

	day = currentDateString.slice(8, 10);
	month = currentDateString.slice(4, 7);
	year = currentDateString.slice(11, 15);
				
	dateFormatted = formatDate(day, month, year);			
	
	//------------------GOAL DATE-------------------

	var goalDateFormatted = goalDate;
				
	//---------APPENDING NEW COMMITMENT (DIV)---------------

	
	//-----COLOUR-----
	var colourVar = determineColour();
	
	//-----CLASS-----
	var classVar;
	var treePos;
	if(realCommitCounter%2 != 0) {
		classVar="commitmentLeft";
		treePos="treeLineLeft";
	} else {
		classVar="commitmentRight";
		treePos="treeLineRight";
	}
	
	//-----TREE LINE DIV-----

	var treeFirst = '<div class="';
	var treeLast = '"></div>';
	var treeDiv = treeFirst.concat(treePos, treeLast);
	
	//-----COMMITMENT-----
	var commitmentVar = '<div class="commitText">'.concat(textCommit, '</div>');
	
	//-----ID-----
	var div1 = '<div class="'.concat(classVar, '" ');
	div1 = div1.concat('id = "SCommit', commitCounter.toString(), '" style="border-color: ', colourVar, '">');
	var appearId = 'SCommit'.concat(commitCounter.toString());
	
	//-----TYPE-----
	typeVar = '<div class="typeVar">'.concat(commitSubType.toString(), '</div>');
	
	//-----SHARE-----
	shareVar = '<div class="share">Share:</div>';
	
	//-----FACEBOOK BUTTON-----
	var faceFirst = '<input type="button" class="fbButton" id="fb';
	var faceLast = '" value="FB" onclick="share(this.id)">';
	var faceButton = faceFirst.concat(commitCounter.toString(), faceLast);
	
	//-----LINKEDIN BUTTON-----
	var linkedInFirst = '<input type="button" class="linkedInButton" id="li';
	var linkedInLast = '" value="LI" onclick="share(this.id)">';
	var linkedInButton = linkedInFirst.concat(commitCounter.toString(), linkedInLast);
	
	//-----Delete Button-----
	var delFirst = '<input type="button" class="delete" id="SDel'
	var delLast = '" value="Delete" onclick="deleteCommitment(this.id)">'
	var delButton = delFirst.concat(commitCounter.toString(), delLast);
	
	//-----Complete Button-----
	var comFirst = '<input type="button" class="finish" id="SCom';
	var comLast = '" value="Completed!!!" onclick="finishedCommitment(this.id)">';
	var completeButton = comFirst.concat(commitCounter, comLast);
	
	//-----Date-----
	var date = '<div class="date">'.concat(dateFormatted, '</div>');
	
	//-----Goal Date-----
	var goalDateVar = '<div class="goalDate">'.concat(goalDateFormatted, '</div>');
	
	//-----Finish-----
	var endDiv = '</div>';
	
	var finalDiv = "";
	
	//-----Concatenating All-----
	
	finalDiv = finalDiv.concat(div1, commitmentVar, typeVar, shareVar, faceButton, linkedInButton, /*date, goalDateVar, delButton,*/ treeDiv, endDiv);
	
	var commits = document.getElementById("commitDivs");
	
	commits.innerHTML = finalDiv + commits.innerHTML;
	
	$(document.getElementById(appearId)).show('blind');
}

// $('#clear').click( function()
// {
	// document.getElementById('#realTextCommit').value = "Optional description...";
// });
function share(id) {
	alert("time to share " + id + " with the world");
}

function removeText(id) {
	document.getElementById(id).value = "";
	
}

function searchKeyPress(e)
    {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13)
        {				
			document.getElementById('submit').click();
			removeText();		
            return false;
        }
        return true;
    }
	


// $("#realTextCommit").keyup(function(event){
		
// });

function replaceText() {
	alert("sweet to here");
	alert(document.getElementById('realTextCommit').value);
}

//Trying to replace text after clicking in and then out of text box
$(document).click(function() 
{
	document.getElementById('realTextCommit').value = "Type commitment here...";
})

function deleteCommitment(idOfDelButton) {
	
	
	var button = document.getElementById(idOfDelButton);
	var divId = $(button).parent().attr('id');
	var parentId = $(button).parent().parent().attr('id');
	
	if(parentId.localeCompare(document.getElementById('completedCommitments').getAttribute('id')) == 0) {
		SCompleteCounter--;
	} else {
		realCommitCounter--;
	}
	
	$(document.getElementById(divId)).hide();
	
	if(realCommitCounter == 0) {
		$('#headings').hide();
		$('#noneSubmit').show();
	}
	
	if(SCompleteCounter == 0) {
		$('#comHeadings').hide();
		$('#noneComplete').show();
	}
}

function finishedCommitment(idOfComButton) {
	SCompleteCounter++;
	realCommitCounter--;
	var button = document.getElementById(idOfComButton);
	$(button).hide();
	
	var divId = $(button).parent().attr('id');
	
	document.getElementById('completedCommitments').appendChild(document.getElementById(divId));
	//MAYBE JUST CREATE ENTIRELY NEW DIV?
	//Look into getting elements from a div and saving them...
	
	if(realCommitCounter == 0) {
		$('#headings').hide();
		$('#noneSubmit').show();
	}
	$('#noneComplete').hide();
	$('#comHeadings').show();
}