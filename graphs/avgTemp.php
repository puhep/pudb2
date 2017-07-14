<head>
  <title>Average temperature</title>
</head>
<body>
  <div id="avgTempPlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="../js/graph.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: '../php/getAvgTempData.php?id='+id,
      success: avgTemp
    });
  </script>
</body>
