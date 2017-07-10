<head>
  <title>Sheet Mesh</title>
  <script src="../node_modules/jquery/dist/jquery.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
  <div id="meshPlot"><!-- Placeholder for plot --></div>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: '../php/getSheetContour.php?id=' + id,
      success: createPlot
    }).fail({
      function() {
        alert('failed');
      }
    });
    function createPlot(response) {
      graphData = JSON.parse(response);
      var data = [
        {
          x: graphData.x,
          y: graphData.y,
          z: graphData.z,
          type: 'mesh3d',
          opacity: 0.8,
          color: 'rgb(171,154,164)'
        }
      ];

      var layout = {
        title: "Mesh",
      };

      Plotly.newPlot("meshPlot", data, layout);
    }
  </script>
</body>
