<head>
  <title>Sheet Contour</title>
  <script src="../node_modules/jquery/dist/jquery.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
  <div id="contourPlot"><!-- Placeholder for plot --></div>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: "../php/getSheetContour.php?id=" + id,
      success: createPlot
    });
    function createPlot(response) {
      graphData = JSON.parse(response);
      var data = [
        {
          x: graphData.x,
          y: graphData.y,
          z: graphData.z,
          type: "contour"
        }
      ];
      var layout = {
        title: "Contour"
      };
      // Display plot
      Plotly.newPlot("contourPlot", data, layout);
    }
  </script>
</body>
