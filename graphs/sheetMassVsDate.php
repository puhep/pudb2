<head>
  <title>Sheet Mass VS Date</title>
</head>
<body>
  <div id="massPlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="../js/graph.js" charset="utf-8"></script>
  <script type="text/javascript">
    $.ajax({
      url: '../php/getMassVsDate.php',
      success: massVsDate
    });
  </script>
</body>
