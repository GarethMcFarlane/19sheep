      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawChart);
      var json = {"status":0,"body":{"activities":[{"date":"2015-09-02","steps":13800,"distance":15355.792,"calories":1178.28,"totalcalories":3102.76,"elevation":0,"soft":1500,"moderate":1080,"intense":3120,"timezone":"Australia\/Brisbane"},{"date":"2015-09-03","steps":8542,"distance":8575.011,"calories":429.1,"totalcalories":2414.1,"elevation":0,"soft":1500,"moderate":1320,"intense":780,"timezone":"Australia\/Brisbane"},{"date":"2015-08-04","steps":5134,"distance":4557.756,"calories":233.39,"totalcalories":2247.4,"elevation":0,"soft":2340,"moderate":480,"intense":0,"timezone":"Australia\/Sydney"},{"date":"2015-08-05","steps":12120,"distance":10319.596,"calories":577.65,"totalcalories":2503.41,"elevation":0,"soft":4020,"moderate":2460,"intense":0,"timezone":"Australia\/Sydney"},{"date":"2015-08-06","steps":11810,"distance":11346.007,"calories":629.65,"totalcalories":2564.09,"elevation":0,"soft":3060,"moderate":2700,"intense":360,"timezone":"Australia\/Sydney"},{"date":"2015-08-07","steps":4745,"distance":4165.819,"calories":208.64,"totalcalories":2240.02,"elevation":0,"soft":1860,"moderate":240,"intense":0,"timezone":"Australia\/Sydney"},{"date":"2015-08-08","steps":15608,"distance":14593.814,"calories":797.14,"totalcalories":2660.68,"elevation":0,"soft":5760,"moderate":3180,"intense":120,"timezone":"Australia\/Sydney"},{"date":"2015-08-09","steps":21832,"distance":21843.799,"calories":1274.02,"totalcalories":3107.18,"elevation":0,"soft":3240,"moderate":5880,"intense":1200,"timezone":"Australia\/Perth"},{"date":"2015-08-10","steps":13099,"distance":13628.764,"calories":896.97,"totalcalories":2835.75,"elevation":0,"soft":2460,"moderate":2220,"intense":1800,"timezone":"Australia\/Perth"},{"date":"2015-08-11","steps":8008,"distance":7033.218,"calories":379.11,"totalcalories":2352.61,"elevation":0,"soft":3120,"moderate":1380,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-12","steps":15654,"distance":16553.008,"calories":1105.96,"totalcalories":3010.01,"elevation":0,"soft":2580,"moderate":2820,"intense":1980,"timezone":"Australia\/Perth"},{"date":"2015-08-13","steps":8869,"distance":7627.2,"calories":420.33,"totalcalories":2383.7,"elevation":0,"soft":3000,"moderate":1920,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-14","steps":13976,"distance":14304.238,"calories":870.67,"totalcalories":2793.53,"elevation":0,"soft":2460,"moderate":3060,"intense":1140,"timezone":"Australia\/Perth"},{"date":"2015-08-15","steps":11231,"distance":10374.938,"calories":562.1,"totalcalories":2495.09,"elevation":0,"soft":3900,"moderate":1920,"intense":360,"timezone":"Australia\/Brisbane"},{"date":"2015-08-16","steps":14102,"distance":13171.729,"calories":765.6,"totalcalories":2666.76,"elevation":0,"soft":4860,"moderate":2160,"intense":480,"timezone":"Australia\/Brisbane"},{"date":"2015-08-17","steps":11177,"distance":11218.594,"calories":674.92,"totalcalories":2626.72,"elevation":0,"soft":2280,"moderate":2280,"intense":840,"timezone":"Australia\/Brisbane"},{"date":"2015-08-18","steps":7500,"distance":6671.63,"calories":351.74,"totalcalories":2341.16,"elevation":0,"soft":2580,"moderate":1260,"intense":0,"timezone":"Australia\/Brisbane"},{"date":"2015-08-19","steps":19911,"distance":21182.191,"calories":1531.34,"totalcalories":3376.07,"elevation":0,"soft":4200,"moderate":2460,"intense":3180,"timezone":"Australia\/Brisbane"},{"date":"2015-08-20","steps":12499,"distance":11867.628,"calories":664.92,"totalcalories":2589.23,"elevation":0,"soft":3720,"moderate":2400,"intense":420,"timezone":"Australia\/Brisbane"},{"date":"2015-08-21","steps":7095,"distance":6281.047,"calories":324.22,"totalcalories":2328.11,"elevation":0,"soft":2760,"moderate":720,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-22","steps":14253,"distance":13204.309,"calories":737.23,"totalcalories":2647.07,"elevation":0,"soft":3900,"moderate":2760,"intense":480,"timezone":"Australia\/Perth"},{"date":"2015-08-23","steps":6189,"distance":5502.84,"calories":293.52,"totalcalories":2306.09,"elevation":0,"soft":1920,"moderate":960,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-24","steps":14725,"distance":16115.051,"calories":1212.79,"totalcalories":3138.55,"elevation":0,"soft":2040,"moderate":1500,"intense":2940,"timezone":"Australia\/Perth"},{"date":"2015-08-25","steps":7485,"distance":6554.667,"calories":349.98,"totalcalories":2335.06,"elevation":0,"soft":2760,"moderate":1260,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-26","steps":8986,"distance":7812.128,"calories":423.86,"totalcalories":2393.02,"elevation":0,"soft":2880,"moderate":1800,"intense":0,"timezone":"Australia\/Perth"},{"date":"2015-08-27","steps":12126,"distance":12014.105,"calories":696.59,"totalcalories":2648.39,"elevation":0,"soft":1380,"moderate":3600,"intense":660,"timezone":"Australia\/Perth"},{"date":"2015-08-28","steps":12520,"distance":12316.366,"calories":725.76,"totalcalories":2668.88,"elevation":0,"soft":1980,"moderate":3360,"intense":600,"timezone":"Australia\/Brisbane"},{"date":"2015-08-29","steps":15231,"distance":13819.646,"calories":780.43,"totalcalories":2674.36,"elevation":0,"soft":3660,"moderate":3960,"intense":240,"timezone":"Australia\/Brisbane"},{"date":"2015-08-30","steps":5219,"distance":4650.588,"calories":236.17,"totalcalories":2263.21,"elevation":0,"soft":1560,"moderate":720,"intense":0,"timezone":"Australia\/Brisbane"},{"date":"2015-08-31","steps":10938,"distance":11084.526,"calories":674.97,"totalcalories":2633.46,"elevation":0,"soft":1980,"moderate":1860,"intense":900,"timezone":"Australia\/Brisbane"},{"date":"2015-09-01","steps":6340,"distance":5664.896,"calories":298.65,"totalcalories":2324.66,"elevation":0,"soft":2220,"moderate":1140,"intense":0,"timezone":"Australia\/Brisbane"}]}};
      var act_data = getActivityData(json);
      var act_value = totalActivityScore(act_data);

      function drawChart() {
        var act_data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          [' ', act_value],
        ]);

        var act_options = {
          min:0, max:3000,
          width: 800, height: 240,
          redFrom: 0, redTo: 750,
          yellowFrom:750, yellowTo: 1500,
          greenFrom:1500, greenTo:3000,
          minorTicks: 5
        };

        var act_chart = new google.visualization.Gauge(document.getElementById('chart_2'));

        act_chart.draw(act_data, act_options);

        setInterval(function() {
          act_data.setValue(0, 0, 1);
          act_chart.draw(act_data, act_options);
        }, 13000);
      }