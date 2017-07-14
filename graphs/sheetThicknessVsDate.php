<head>
  <title>Sheet Thickness Vs Date</title>
</head>
<body>
  <div id="thicknessPlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="../js/graph.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    $.ajax({
      url: '../php/getThicknessVsDate.php',
      success: thickVsDate
    });
  </script>
</body>
