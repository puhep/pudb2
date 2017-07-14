<head>
  <title>Temperature Vs Time</title>
</head>
<body>
  <div id="tempVsTimePlot"></div>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="../js/graph.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    var data = [];
    $.ajax({
      url: '../php/getTempVsTimeData.php?id=' + id,
      success: TempVsTime
    });
  </script>
</body>
