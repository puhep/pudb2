<head>
  <title>Sheet Contour</title>
</head>
<body>
  <div id="contourPlot"><!-- Placeholder for plot --></div>
  <script src="../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="../js/graph.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: "../php/getSheetContour.php?id=" + id,
      success: sheetContour
    });
  </script>
</body>
