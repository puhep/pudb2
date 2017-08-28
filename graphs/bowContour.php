<head>
  <title>Sheet Bow</title>
</head>
<body>
  <div id="bowPlot"><!-- Placeholder for plot --></div>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="https://root.cern/js/latest/scripts/JSRootCore.js"></script>
  <script src="../js/graph.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    var id = <?php echo $_GET['id']; ?>;
    $.ajax({
      url: "../php/getSheetBow.php?id=" + id,
      success: SheetBowContour
    });
  </script>
</body>
