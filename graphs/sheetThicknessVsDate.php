<?php
  /******************
  * REQUIRE
  ******************/
  require_once("../database.php");
  $db = new Database();
  $sheets3 = $db->db_query("SELECT avgThickness, name, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=3");
  $sheets8 = $db->db_query("SELECT avgThickness, name, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=8");

  // Graph Data
  $dataY3    = array();
  $dataX3    = array();
  $dataName3 = array();
  for ($i = 0; $i < sizeof($sheets3); $i++) {
    if ($sheets3[$i]['avgThickness'] == "") {
      $dataY3[$i] = (($sheets3[$i]['thickness1'] + $sheets3[$i]['thickness2'] + $sheets3[$i]['thickness3'] + $sheets3[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY3[$i] = $sheets3[$i]['avgThickness'] * 1000;
    }
    $dataX3[$i]    = $sheets3[$i]['dateCut'];
    $dataName3[$i] = $sheets3[$i]['name'];
  }
  $dataY8    = array();
  $dataX8    = array();
  $dataName8 = array();
  for ($i = 0; $i < sizeof($sheets8); $i++){
    if ($sheets8[$i]['avgThickness'] == null) {
      $dataY8[$i] = (($sheets8[$i]['thickness1'] + $sheets8[$i]['thickness2'] + $sheets8[$i]['thickness3'] + $sheets8[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY8[$i] = $sheets8[$i]['avgThickness'] * 1000;
    }
    $dataX8[$i]    = $sheets8[$i]['dateCut'];
    $dataName8[$i] = $sheets8[$i]['name'];
  }

?>
<head>
  <title>Sheet Thickness Vs Date</title>
  <script src="../node_modules/jquery/dist/jquery.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
  <div id="thicknessPlot"></div>
  <script type="text/javascript">
    var x1 = [
      <?php
        for ($i = 0; $i < sizeof($dataX3)-1; $i++) {
          echo "'".$dataX3[$i]."', ";
        }
        echo "'".$dataX3[$i]."'";
      ?>
    ];
    var y1 = [
      <?php
        for ($i = 0; $i < sizeof($dataY3)-1; $i++) {
          echo $dataY3[$i].", ";
        }
        echo $dataY3[$i];
      ?>
    ];
    var text1 = [
      <?php
        for ($i = 0; $i < sizeof($dataName3)-1; $i++) {
          echo "\"".$dataName3[$i]."\", ";
        }
        echo "\"".$dataName3[$i]."\"";
      ?>
    ];
    var x2 = [
      <?php
        for ($i = 0; $i < sizeof($dataX8)-1; $i++) {
          echo "'".$dataX8[$i]."', ";
        }
        echo "'".$dataX8[$i]."'";
      ?>
    ];
    var y2 = [
      <?php
        for ($i = 0; $i < sizeof($dataY8)-1; $i++) {
          echo $dataY8[$i].", ";
        }
        echo $dataY8[$i];
      ?>
    ];
    var text2 = [
      <?php
        for ($i = 0; $i < sizeof($dataName8)-1; $i++) {
          echo "\"".$dataName8[$i]."\", ";
        }
        echo "\"".$dataName8[$i]."\"";
      ?>
    ];
    var trace1 = {
      x: x1,
      y: y1,
      text: text1,
      name: '3 Ply',
      marker: {
        size: 12,
        color: 'red'
      },
      mode: 'markers',
      type: 'scatter'
    };
    var trace2 = {
      x: x2,
      y: y2,
      text: text2,
      name: '8 Ply',
      marker : {
        size: 12,
        color: 'blue'
      },
      mode: 'markers',
      type: 'scatter'
    }
    var layout = {
      xaxis: {
        showgrid: false,
      },
      title: 'Sheet Thickness Vs Date'
    };
    var data = [trace1, trace2];
    Plotly.newPlot('thicknessPlot', data, layout);
  </script>
</body>
