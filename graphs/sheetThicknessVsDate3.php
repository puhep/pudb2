<?php
  /******************
  * REQUIRE
  ******************/
  require_once("../database.php");
  $db = new Database();
  $sheets = $db->db_query("SELECT avgThickness, thickness1, thickness2, thickness3, thickness4, dateCut, name FROM sheet WHERE ply=3");

  // Graph Data
  $dataY = array();
  $dataX = array();
  $dataName = array();
  for ($i = 0; $i < sizeof($sheets); $i++) {
    if ($sheets[$i]['avgThickness'] == "") {
      $dataY[$i] = (($sheets[$i]['thickness1'] + $sheets[$i]['thickness2'] + $sheets[$i]['thickness3'] + $sheets[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY[$i] = $sheets[$i]['avgThickness'] * 1000;
    }
    $dataX[$i] = $sheets[$i]['dateCut'];
    $dataName[$i] = $sheets[$i]['name'];
  }
?>
<head>
  <title>Sheet Thickness Vs Date - 3 Plies</title>
  <script src="../node_modules/jquery/dist/jquery.js" charset="utf-8"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
  <div id="thicknessPlot"></div>
  <script type="text/javascript">
    var x = [
      <?php
        for ($i = 0; $i < sizeof($dataX)-1; $i++) {
          echo "'".$dataX[$i]."', ";
        }
        echo "'".$dataX[$i]."'";
      ?>
    ];
    var y = [
      <?php
        for ($i = 0; $i < sizeof($dataY)-1; $i++) {
          echo $dataY[$i].", ";
        }
        echo $dataY[$i];
      ?>
    ];
    var text = [
      <?php
        for ($i = 0; $i < sizeof($dataName)-1; $i++) {
          echo "\"".$dataName[$i]."\", ";
        }
        echo "\"".$dataName[$i]."\"";
      ?>
    ];
    var trace = {
      x: x,
      y: y,
      text: text,
      marker: {
        size: 12,
        color: 'red'
      },
      mode: 'markers',
      type: 'scatter'
    };
    var layout = {
      xaxis: {
        showgrid: false,
      },
      title: 'Sheet Thickness Vs Datae -- 3 Plies'
    };
    var data = [trace];
    Plotly.newPlot('thicknessPlot', data, layout);
  </script>
</body>
