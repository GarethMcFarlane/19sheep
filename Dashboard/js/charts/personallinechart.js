google.load('visualization', '1.1', {packages: ['line','corechart','timeline']});
google.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('datetime', 'Time');
      data.addColumn('number', 'Sleep Level');



      data.addRows([
      [new Date(2015,07,11,21,54,39),2],
      [new Date(2015,07,11,22,00,49),3],
      [new Date(2015,07,11,23,07,49),2],
      [new Date(2015,07,11,23,24,49),3],
      [new Date(2015,07,12,00,24,49),2],
      [new Date(2015,07,12,00,43,49),3],
      [new Date(2015,07,12,01,41,49),2],
      [new Date(2015,07,12,02,22,49),2],
      [new Date(2015,07,12,02,51,49),3],
      [new Date(2015,07,12,03,24,49),2],
      [new Date(2015,07,12,03,55,49),3],
      [new Date(2015,07,12,04,29,49),2],
      [new Date(2015,07,12,04,42,40),3],
      [new Date(2015,07,12,04,56,49),2],
      [new Date(2015,07,12,05,07,49),1],
      [new Date(2015,07,12,05,20,49),0]
      ]);

      var options = {
        title: 'Sleep Data for 01/07/2015',
        curveType: 'function',
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Sleep Level'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('line_div'));

      chart.draw(data, options);
    }