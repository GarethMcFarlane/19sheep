var textCommit;
var commitCounter=0;
var realCommitCounter=0;
var SCompleteCounter=0;
var goalDate;
var commitType;
var commitSubType;
var target;
var treeLength;

var textCommit2;
var commitCounter2=0;
var realCommitCounter2=0;
var ACompleteCounter=0;

function showForm() {
	var list = document.getElementById('commitType');
	commitType=list.options[list.selectedIndex].text;

	if(commitType.localeCompare("Activity") == 0) {
		$('#activityForm').show();
		$('#sleepForm').hide();
	} else {
		$('#sleepForm').show();
		$('#activityForm').hide()
		
	}
}

function hideForm() {
	if(commitType.localeCompare("Activity") == 0) {
		$('#activityForm').hide();
	} else if(commitType.localeCompare("Sleep") == 0) {
		$('#sleepForm').hide();
	}
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

function fieldsSelected() {
	var list;
	document.getElementById("commitType").selectedIndex = 0;
	if(commitType.localeCompare("Activity") == 0) {
		list = document.getElementById('activityType');
		commitSubType=list.options[list.selectedIndex].text;
		document.getElementById('activityType').selectedIndex = 0;
		
		target = document.getElementById('activityTarget');
		document.getElementById('activityTarget').value = "click to enter";
		
		goalDate = document.getElementById('activityGDate').value.toString();
		document.getElementById('activityGDate').value = "dd-mm-yyyy";
		
		textCommit = document.getElementById('activityCommit').value.toString();
		document.getElementById('activityCommit').value = "Enter Commitment...";
		
	} else if(commitType.localeCompare("Sleep") == 0) {
		list = document.getElementById('sleepType');
		commitSubType=list.options[list.selectedIndex].text;
		document.getElementById('sleepType').selectedIndex = 0;
		
		target = document.getElementById('sleepTarget');
		document.getElementById('sleepTarget').value = "click to enter";
		
		goalDate = document.getElementById('sleepGDate').value.toString();
		document.getElementById('sleepGDate').value = "dd-mm-yyyy";
		
		textCommit = document.getElementById('sleepCommit').value.toString();
		document.getElementById('sleepCommit').value = "Enter Commitment...";
	}
}

function PainNGain() {
	fieldsSelected();

	if(textCommit.localeCompare("Enter sleep commitment...") == 0 || !textCommit) {
		alert("No pain no gain, champ...");
	} else {
		newCommitment();
		hideForm();
	}
}

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
	
	treeLength = 120 + realCommitCounter*140;
	
	commitCounter++;
	realCommitCounter++;
	
	treeLength = treeLength.toString().concat('px');
	
	document.getElementById('treeLine').style.height = treeLength;
	
	
	

	if(realCommitCounter >= 1) {
		$('#headings').show();
		$('#noneSubmit').hide();
	}
			

	//--------------CLASS CHANGE---------------
	/* var commitClass;
	if(textCommit.length > 30) {
		alert();
		commitClass = "commitment";
	} else {
		commitClass = "commitment2";
	}
	
	commitClass='class="'.concat(commitClass, '"'); */

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
	if(realCommitCounter%2 != 0) {
		classVar="commitmentLeft";
	} else {
		classVar="commitmentRight";
	}
	
	//-----COMMITMENT-----
	var commitmentVar = '<div class="commitText">'.concat(textCommit, '</div>');
	
	//-----ID-----
	var div1 = '<div class="'.concat(classVar, '" ');
	div1 = div1.concat('id = "SCommit', commitCounter.toString(), '" style="border-color: ', colourVar, '">');
	
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
	finalDiv = finalDiv.concat(div1, commitmentVar, typeVar, shareVar, faceButton, linkedInButton, /*date, goalDateVar, delButton,*/ endDiv);
	
	var commits = document.getElementById("commitDivs");
	
	commits.innerHTML = finalDiv + commits.innerHTML;
	
	//saveTextAsFile();
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
//----------------------------------------------------------------------------------
//                                ACTIVITY COMMITMENTS								|
//----------------------------------------------------------------------------------


function PainNGain2() {
	textCommit2 = document.getElementById('realTextCommit2').value.toString();
	
	if(textCommit2.localeCompare("Enter activity commitment...") == 0 || !textCommit2) {
		alert("No one ever gained something from an empty commitment...");
	} else {
		newCommitment2();
	}
}

function newCommitment2() {

	commitCounter2++;
	realCommitCounter2++;

	if(realCommitCounter2 >= 1) {
		$('#headings2').show();
		$('#noneSubmit2').hide();
	}
	
	textCommit2 = document.getElementById('realTextCommit2').value.toString();
	
	if(textCommit2.localeCompare("Enter activity commitment...") == 0 || !textCommit2) {
		textCommit2 = "none given";
	}
	
	document.getElementById('realTextCommit2').value = "Enter activity commitment...";
	
	// /*------------------DATE-------------------*/
	var currentDate = Date.now();
	var currentDateString = Date(currentDate).toString();
				
	var day = "";
	var	month = "";
	var year = "";
	var dateFormatted = "";

	day = currentDateString.slice(8, 10);
	month = currentDateString.slice(4, 7);
	year = currentDateString.slice(11, 15);
				
	dateFormatted = dateFormatted.concat(day, "/", month, "/", year);
		
	// /*---------APPENDING NEW COMMITMENT (DIV)---------------*/
	// /*-----ID-----*/
	var div1 = '<div class="commitment" ';
	div1 = div1.concat('id = "AComit', commitCounter2.toString(), '">');
	
	// /*-----Delete Button-----*/
	var delFirst = '<input type="button" class="delete" id="ADel'
	var delLast = '" value="Delete" onclick="deleteCommitment2(this.id)">'
	var delButton = delFirst.concat(commitCounter2.toString(), commitCounter2.toString()/*String.fromCharCode(97 + commitCounter)*/, delLast);
	
	// /*-----Complete Button-----*/
	var comFirst = '<input type="button" class="finish" id="ACom'
	var comLast = '" value="Completed!!!" onclick="finishedCommitment2(this.id)">'
	//var comId = "";
	//comId = comId.concat(commitCounter2.toString()/*String.fromCharCode(97 + commitCounter)*/, commitCounter2.toString(), commitCounter2.toString());
	var completeButton = comFirst.concat(commitCounter2, comLast);
	
	// /*-----Date-----*/
	var date = '<div class="date">'.concat(dateFormatted, '</div>');
	
	// /*-----Finish-----*/
	var endDiv = '</div>';
	
	var finalDiv = "";
	
	// /*-----Concatenating All-----*/
	finalDiv = finalDiv.concat(div1, textCommit2, date, completeButton, delButton, endDiv);
	
	var commits = document.getElementById("commitDivs2");
	
	commits.innerHTML = finalDiv + commits.innerHTML;
}

function removeText2() {
	document.getElementById('realTextCommit2').value = "";
}

function searchKeyPress2(e)
    {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13)
        {				
			document.getElementById('submit2').click();
			removeText2();		
            return false;
        }
        return true;
    }

function replaceText2() {
	alert("sweet to here");
	alert(document.getElementById('realTextCommit2').value);
}

//Trying to replace text after clicking in and then out of text box
$(document).click(function() 
{
	document.getElementById('realTextCommit2').value = "Type commitment here...";
})

function deleteCommitment2(idOfDelButton) {
	
	
	var button = document.getElementById(idOfDelButton);
	var divId = $(button).parent().attr('id');
	var parentId = $(button).parent().parent().attr('id');
	
	if(parentId.localeCompare(document.getElementById('completedCommitments2').getAttribute('id')) == 0) {
		ACompleteCounter--;
	} else {
		realCommitCounter2--;
	}
	
	$(document.getElementById(divId)).hide();
	
	if(realCommitCounter2 == 0) {
		$('#headings2').hide();
		$('#noneSubmit2').show();
	}
	
	if(ACompleteCounter == 0) {
		$('#comHeadings2').hide();
		$('#noneComplete2').show();
	}
}

function finishedCommitment2(idOfComButton) {
	realCommitCounter2--;
	ACompleteCounter++;
	var button = document.getElementById(idOfComButton);
	$(button).hide();
	
	var divId = $(button).parent().attr('id');
	
	document.getElementById('completedCommitments2').appendChild(document.getElementById(divId));
	//MAYBE JUST CREATE ENTIRELY NEW DIV?
	//Look into getting elements from a div and saving them...
	
	if(realCommitCounter2 == 0) {
		$('#headings2').hide();
		$('#noneSubmit2').show();
	}
	$('#noneComplete2').hide();
	$('#comHeadings2').show();
}