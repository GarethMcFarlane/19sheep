

var act_days_bank;


$.ajax({
  type: 'POST',
  url: 'activitymeasures.php',
  async: false,
  data: {test: '1'},
  dataType: 'text',
  success: function(response){
    act_days_bank = JSON.parse(response);
  }
});  

var firstname;

$.ajax({
  type: 'POST',
  url: 'getfirstname.php',
  async: false,
  data: {test: '1'},
  dataType: 'text',
  success: function(response){
    firstname = response;
  }
});  


google.load('visualization', '1', {packages: ['corechart', 'bar']});
	google.setOnLoadCallback(drawAxisTickColors);
  var daysName = getPreviousDaysName(3);
  var colors = generateActivityColors(act_days_bank,3);
  function drawAxisTickColors() {
      var act_data_bank = google.visualization.arrayToDataTable([
        ['bars','1',{ role: 'style' },'2',{ role: 'style' }],
        [daysName[2],2,colors[4],2,colors[5]],
        [daysName[1],2,colors[2],2,colors[3]],
        [daysName[0],2,colors[0],2,colors[1]],
        ]);
      var act_options_bank = {
        enableInteractivity: false,
      	isStacked: true, 
      	legend: 'none', //disable the "color hint" at the top right corner.
      	bar:{
      	  groupWidth: '95%' //disable the gap from the top and the bottom.
      	},
        tooltip:{
          trigger: 'none',  //disable the pop up when hover over.
          ignoreBounds: 'true'
        },
        // chartArea: {
        // 	width: '30%',
        //     height: '50%'
        // },
        hAxis: {
          textPosition: 'none', //disable the value at the horizontal axis.
          maxValue: 4 //6*4 = 24 i.e. google chart sperate the graph in 4 parts, in order to fill up the graph, the maximum have to be set to 24
         },
        vAxis: {
          title: ' ', //disable the y axis title.
          textStyle:{
            fontSize: '14'
          },
        }
      };
      var act_chart_bank = new google.visualization.BarChart(document.getElementById('chart_3'));
      act_chart_bank.draw(act_data_bank, act_options_bank);
      $("#activitybank").append(getActivityBankMessage(colors, daysName));
  }
