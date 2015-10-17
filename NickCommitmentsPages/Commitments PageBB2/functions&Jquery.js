var textCommit;
var commitCounter=0;
var realCommitCounter=0;
var SCompleteCounter=0;

var textCommit2;
var commitCounter2=0;
var realCommitCounter2=0;
var ACompleteCounter=0;


function PainNGain() {
	textCommit = document.getElementById('realTextCommit').value.toString();
	
	if(textCommit.localeCompare("Enter sleep commitment...") == 0 || !textCommit) {
		alert("No pain no gain, champ...");
	} else {
		newCommitment();
	}
}

function newCommitment() {
	
	//saveTextAsFile();
	
	
	
	commitCounter++;
	realCommitCounter++;

	if(realCommitCounter >= 1) {
		$('#headings').show();
		$('#noneSubmit').hide();
	}

	// textCommit = document.getElementById('realTextCommit').value.toString();
	
	// if(textCommit.localeCompare("Enter sleep commitment...") == 0 || !textCommit) {
		// textCommit = "none given";
	// }
	
	document.getElementById('realTextCommit').value = "Enter sleep commitment...";
	
	//------------------DATE-------------------
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
	
	
	
	
				
	//---------APPENDING NEW COMMITMENT (DIV)---------------
	//-----ID-----
	var div1 = '<div class="commitment" ';
	div1 = div1.concat('id = "SCommit', commitCounter.toString(), '" >');
	
	//-----Delete Button-----
	var delFirst = '<input type="button" class="delete" id="SDel'
	var delLast = '" value="Delete" onclick="deleteCommitment(this.id)">'
	var delButton = delFirst.concat(commitCounter.toString(), delLast);
	
	//-----Complete Button-----
	var comFirst = '<input type="button" class="finish" id="SCom';
	var comLast = '" value="Completed!!!" onclick="finishedCommitment(this.id)">';
	//var comId = "";
	//comId = comId.concat(commitCounter.toString());
	var completeButton = comFirst.concat(commitCounter, comLast);
	
	//-----Date-----
	var date = '<div class="date">'.concat(dateFormatted, '</div>');
	
	//-----Finish-----
	var endDiv = '</div>';
	
	var finalDiv = "";
	
	//-----Concatenating All-----
	finalDiv = finalDiv.concat(div1, textCommit, date, completeButton, delButton, endDiv);
	
	var commits = document.getElementById("commitDivs");
	
	commits.innerHTML = finalDiv + commits.innerHTML;
	
	//saveTextAsFile();
}



// $('#clear').click( function()
// {
	// document.getElementById('#realTextCommit').value = "Optional description...";
// });
function removeText() {
	document.getElementById('realTextCommit').value = "";
	
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