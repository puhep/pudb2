<?php
  /*******************
  * REQUIRE
  *******************/
  require_once("../database.php");
  require_once("../functions.php");
  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_contour.php");

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
    $x[$i] = $temp[0];
    $y[$i] = $temp[1];
    $z[$i++] = $temp[2];
  }
  fclose($file); // save memory, close file

  /*******************
  * SETUP GRAPH
  *******************/
  $graph = new Graph(1200, 1200);
  $graph->SetScale('intint', 0, 0, 0, 0);
  $graph->SetMarginColor('#F9DAC6');

  // Title Stuff
  $graph->title->Set("Sheet Thickness Contour");
  $graph->title->SetFont(FF_ARIAL,FS_BOLD,12);

?>
