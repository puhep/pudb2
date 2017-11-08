<?php
  $id = $_GET['id'];
  $dir1 = "../../phase_2/files/sheet/$id/ThicknessContour.csv";
  $dir2 = "../../phase_2/files/sheet/$id/BowContour.csv";
  $out = "../../phase_2/pics/sheet/$id";
  $test  = "none";
  $test1 = "none";
  $res   = "";
  $res1  = "":
  if (!file_exists($out)) {
    mkdir($out);
    chmod($out, 0777);
  }

  if (file_exists($dir1)) {
    $test = system("./ContourPlot $id \"ThicknessContour.csv\" \"Thickness Contour\" \"contourPlot.png\"", $res);
  }
  if (file_exists($dir2)) {
    $test1 = system("./ContourPlot ".$id." \"BowContour.csv\" \"Bow Contour\" \"bowPlot.png\"", $res1);
  }
  $return = new stdClass;
  $return->test  = $test;
  $return->res   = $res;
  $return->test1 = $test1;
  $return->res1  = $res1;
  $json = json_encode($return);
  echo $json;
?>
