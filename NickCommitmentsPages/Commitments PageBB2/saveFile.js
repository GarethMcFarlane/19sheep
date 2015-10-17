function saveTextAsFile()
  {      
  // grab the content of the form field and place it into a variable
      var textToWrite = document.getElementById("headings").text;
  //  create a new Blob (html5 magic) that conatins the data from your form feild
      var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
  // Specify the name of the file to be saved
      var fileNameToSaveAs = "currentPage.txt";
      
  // Optionally allow the user to choose a file name by providing 
  // an imput field in the HTML and using the collected data here
  // var fileNameToSaveAs = txtFileName.text;
  
  // create a link for our script to 'click'
      var downloadLink = document.createElement("a");
  //  supply the name of the file (from the var above).
  // you could create the name here but using a var
  // allows more flexability later.
      downloadLink.download = fileNameToSaveAs;
  // provide text for the link. This will be hidden so you
  // can actually use anything you want.
      downloadLink.innerHTML = "My Hidden Link";
      
  // allow our code to work in webkit & Gecko based browsers
  // without the need for a if / else block.
      window.URL = window.URL || window.webkitURL;
            
  // Create the link Object.
      downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
  // when link is clicked call a function to remove it from
  // the DOM in case user wants to save a second file.
      downloadLink.onclick = destroyClickedElement;
  // make sure the link is hidden.
      downloadLink.style.display = "none";
  // add the link to the DOM
      document.body.appendChild(downloadLink);
      
  // click the new link
      downloadLink.click();
  }

function destroyClickedElement(event)
{
// remove the link from the DOM
    document.body.removeChild(event.target);
}

/*<html>
<body>

	<table>
	<tr><td>Text to Save:</td></tr>
	<tr>
		<td colspan="3">
			<textarea id="inputTextToSave" style="width:512px;height:256px"></textarea>
		</td>
	</tr>
	<tr>
		<td>Filename to Save As:</td>
		<td><input id="inputFileNameToSaveAs"></input></td>
		<td><button onclick="saveTextAsFile()">Save Text to File</button></td>
	</tr>
	<tr>
		<td>Select a File to Load:</td>
		<td><input type="file" id="fileToLoad"></td>
		<td><button onclick="loadFileAsText()">Load Selected File</button><td>
	</tr>
</table> */

/* function saveTextAsFile()
{
	var textToWrite = document.getElementById("document").value;
	var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
	var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;

	var downloadLink = document.createElement("a");
	downloadLink.download = fileNameToSaveAs;
	downloadLink.innerHTML = "Download File";
	if (window.webkitURL != null)
	{
		// Chrome allows the link to be clicked
		// without actually adding it to the DOM.
		downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
	}
	else
	{
		// Firefox requires the link to be added to the DOM
		// before it can be clicked.
		downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
		downloadLink.onclick = destroyClickedElement;
		downloadLink.style.display = "none";
		document.body.appendChild(downloadLink);
	}

	downloadLink.click();
}

function destroyClickedElement(event)
{
	document.body.removeChild(event.target);
}

function loadFileAsText()
{
	var fileToLoad = document.getElementById("fileToLoad").files[0];

	var fileReader = new FileReader();
	fileReader.onload = function(fileLoadedEvent) 
	{
		var textFromFileLoaded = fileLoadedEvent.target.result;
		document.getElementById("inputTextToSave").value = textFromFileLoaded;
	};
	fileReader.readAsText(fileToLoad, "UTF-8");
} */