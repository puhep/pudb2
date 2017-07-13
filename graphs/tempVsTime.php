<head>
  <title>Temperature Vs Time</title>
</head>
<body>
  <div id="tempVsTimePlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    var data = [];
    $.ajax({
      url: '../php/getTempVsTimeData.php?id=' + id,
      success: createPlot
    });
    function createPlot(response) {
      graphData = JSON.parse(response);
      for (i = 0; i < graphData.sensor.length; i++) {
        var y = [];
        var x = [];
        for (j = 0; j < graphData.size; j++) {
          x.push(graphData.sensor[i][j][0]);
          y.push(graphData.sensor[i][j][1]);
        } // End of for loop; entries
        var name = graphData.text[i];
        var trace = {
          y: y,
          x: x,
          marker: {
            size: 12,
          },
          mode: 'lines',
          type: 'scatter',
          name: name,
        };
        data.push(trace);
      } // End of for loop; each sensor
      var layout = {
        yaxis: {
            showgrid: false,
            title: 'Temperature'
        },
        xaxis: {
          showgrid: false,
          title: 'Time'
        },
        title: 'Temperature Vs Time'
      };
      Plotly.newPlot('tempVsTimePlot', data, layout);
    }
  </script>
</body>
