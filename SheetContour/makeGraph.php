<?php
  $id = $_GET['id'];
  $dir = "../../phase_2/files/sheet/$id/ThicknessContour.csv";
  $test = "none";
  $res = "";
  if (file_exists($dir)) {
    $test = system("./ContourPlot ".$id, $res);
  }
  $return = new stdClass;
  $return->test = $test;
  $return->res  = $res;
  $json = json_encode($return);
  echo $json;
?>
