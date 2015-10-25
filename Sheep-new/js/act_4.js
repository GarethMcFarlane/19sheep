function AddNamespace3() {
	var svg = jQuery('#chart_div_9 svg');
	svg.attr("xmlns", "http://www.w3.org/2000/svg");
	svg.css('overflow', 'visible');
}
  var days;


    $.ajax({
      type: 'POST',
      url: 'activitymeasures.php',
      async: false,
      data: {test: '1'},
      dataType: 'text',
      success: function(response){
        days = JSON.parse(response);
      }
    });  



  	google.load('visualization', '1', {packages: ['corechart', 'bar']});
  	google.setOnLoadCallback(drawAxisTickColors);
    var todayRealData = getTodayReal(days);
    var weekRealData = getWeekReal(days);
    var temp1 =  covertBasedOnTen(todayRealData);
    var temp2 =  covertBasedOnTen(weekRealData);
    var msgA = getActivityDrillDownMessageA(weekRealData, todayRealData);
    var msgB = getActivityDrillDownMessageB(weekRealData, todayRealData);
    function drawAxisTickColors() {
        var data = google.visualization.arrayToDataTable([
          ['bars','intense',{role:'tooltip'},'moderate',{role:'tooltip'},'soft',{role:'tooltip'}],
          ['Today',temp1[0],todayRealData[0].toFixed(2)+'hrs',temp1[1],todayRealData[1].toFixed(2)+'hrs',temp1[2],todayRealData[2].toFixed(2)+'hrs'],
          ['Weekly',temp2[0],weekRealData[0].toFixed(2)+'hrs',temp2[1],weekRealData[1].toFixed(2)+'hrs',temp2[2],weekRealData[2].toFixed(2)+'hrs'],
          ]);

        var options = {
        	isStacked: true, 
          colors: ['#E00000','#FF8400','#82CA9D'], //change the color of legend
          legend:{
            textStyle:{
            fontSize: '14'
            },
            position: 'top'
          },

        	// legend: 'none', //disable the "color hint" at the top right corner.
        	bar:{
        	  groupWidth: '95%' //disable the gap from the top and the bottom.
        	},
          tooltip:{
            trigger: 'focus'  //disable the pop up when hover over.
          },
          // chartArea: {
          // 	width: '30%',
          //     height: '50%'
          // },
          hAxis: {
            gridlines:{
              color: '#FFFFFF'
            },
            baselineColor: '#FFFFFF',
            textPosition: 'none', //disable the value at the horizontal axis.
            maxValue: 10 //6*4 = 24 i.e. google chart sperate the graph in 4 parts, in order to fill up the graph, the maximum have to be set to 24
           },
          vAxis: {
            textStyle:{
            fontSize: '14'
            },
            title: ' ', //disable the y axis title.
          }
        };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_9'));
          google.visualization.events.addListener(chart, 'ready', AddNamespace3);

        chart.draw(data, options);
        $("#actdrillA").append(getActivityDrillDownMessageA(weekRealData, todayRealData));
        $("#actdrillB").append(getActivityDrillDownMessageB(weekRealData, todayRealData));
      }