<?php
  /*******************
  * REQUIRE
  *******************/
  require_once("../database.php");
  require_once("../functions.php");
  /*******************
  * READ FILE
  *******************/
  $db = new Database();
  $id = $_GET['id'];
  $filePath = "../../phase_2/files/sheet/$id/ThicknessContour.csv";
  $file = fopen($filePath, "r") or die("<h1>Some thing went wrong.</h1><h2>Could not find file.</h2>");
  $x = array();
  $y = array();
  $z = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    if ((double)$temp[0] > 15 && (double)$temp[0] < 300 && (double)$temp[1] > 15 && (double)$temp[1] < 300) {
      $x[$i]   = (double) $temp[0];
      $y[$i]   = (double) $temp[1];
      $z[$i++] = (double) $temp[2];
    }
  }
  fclose($file); // save memory, close file
?>

<head>
  <title>Sheet Contour</title>
  <script src="../node_modules/jquery/dist/jquery.js" charset="utf-8"></script>
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

    <?php
      $sum = $z[0];
      $min = $z[0];
      $max = $z[0];
      for ($i = 1; $i < sizeof($z)-1; $i++) {
        $sum += $z[$i];
        if ($min > $z[$i]) {
          $min = $z[$i];
        } else if ($max < $z[$i]) {
          $max = $z[$i];
        }
      }
      $avg = $sum / $i;
    ?>

    var id = <?php echo $id; ?>;
    var avgThick = <?php echo $avg; ?>;
    var minThick = <?php echo $min; ?>;
    var maxThick = <?php echo $max; ?>;
    var avg = null;
    <?php
      $sql = "SELECT avgThickness FROM sheet WHERE id=$id";
      $data = $db->db_query($sql);
      $data = $data[0];
      $avgThick = $data['avgThickness'];
      if ($avgThick != "") {
        echo "avg = ".$avgThick.";";
      }
    ?>

    if (avg == null) {
      $.ajax({
        url: '../php/updatePart.php?id='+id+'&partType=sheet&field=avgThickness&value='+avgThick,
      });
      $.ajax({
        url: '../php/updatePart.php?id='+id+'&partType=sheet&field=minThickness&value='+minThick,
      });
      $.ajax({
        url: '../php/updatePart.php?id='+id+'&partType=sheet&field=maxThickness&value='+maxThick,
      });
    }
  </script>
</body>
