<head>
  <title>Sheet Thickness Vs Date</title>
</head>
<body>
  <div id="thicknessPlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script type="text/javascript">
    $.ajax({
      url: '../php/getThicknessVsDate.php',
      success: createPlot
    });
    function createPlot(response) {
      graphData = JSON.parse(response);
      var ply3 = {
        x: graphData.x3,
        y: graphData.y3,
        text: graphData.name3,
        name: '3 Ply',
        marker: {
          size: 12,
          color: 'red'
        },
        mode: 'markers',
        type: 'scatter'
      };
      var ply8 = {
        x: graphData.x8,
        y: graphData.y8,
        text: graphData.name8,
        name: '8 Ply',
        marker : {
          size: 12,
          color: 'blue'
        },
        mode: 'markers',
        type: 'scatter'
      }
      var layout = {
        xaxis: {
          showgrid: false,
        },
        title: 'Sheet Thickness Vs Date'
      };
      var data = [ply3, ply8];
      Plotly.newPlot('thicknessPlot', data, layout);
    }
  </script>
</body>
