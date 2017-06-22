<?php
  /*******************
  * REQUIRE
  *******************/
  require_once("../database.php");
  require_once("../functions.php");
  /*******************
  * READ FILE
  *******************/
  $id = $_GET['id'];
  $filePath = "../../phase_2/files/sheet/$id/ThicknessContour.csv";
  $file = fopen($filePath, "r") or die("<h1>Some thing went wrong.</h1><h2>Could not find file.</h2>");
  $line1 = fgetcsv($file);
  $x = array();
  $y = array();
  $z = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    $x[$i]   = (double) $temp[0];
    $y[$i]   = (double) $temp[1];
    $z[$i++] = (double) $temp[2];
  }
  fclose($file); // save memory, close file
?>

<head>
  <title>Sheet Contour</title>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
  <div id="contourPlot"></div>
  <script type="text/javascript">
    var x = [
      <?php
        for ($i = 0; $i < sizeof($x) - 2  ; $i++) {
          echo "$x[$i], ";
        }
        echo "$x[$i]";
      ?>
    ];
    var y = [
      <?php
        for ($i = 0; $i < sizeof($y) - 2; $i++) {
          echo "$y[$i], ";
        }
        echo "$y[$i]";
      ?>
    ];
    var z = [
      <?php
        for ($i = 0; $i < sizeof($z) - 2; $i++) {
          echo "$z[$i], ";
        }
        echo "$z[$i]";
      ?>
    ];
    var data = [
      {
        z: z,
        x: x,
        y: y,
        type: "contour"
      }
    ];

    var layout = {
      title: "Contour"
    };

    Plotly.newPlot("contourPlot", data, layout);
  </script>
</body>
