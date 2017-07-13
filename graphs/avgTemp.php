<head>
  <title>Average temperature</title>
</head>
<body>
  <div id="avgTempPlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: '../php/getAvgTempData.php?id='+id,
      success: createPlot
    });
    function createPlot(response) {
      dbJSON = JSON.parse(response);
      var data = [];
      for (i = 0; i < dbJSON.size.length; i++) {
        var y = [
          dbJSON.avgTemp[i],
          dbJSON.errMax[i],
          dbJSON.errMin[i]
        ];
        var name = dbJSON.avgChan[i];
        var trace = {
          y: y,
          type: 'box',
          name: name,
        };
        data.push(trace);
      } // End of for loop
      Plotly.newPlot('avgTempPlot', data);
    }
  </script>
</body>
