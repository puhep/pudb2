<?php
  /******************
  * Require
  ******************/
  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_scatter.php");
  // require_once("../jpgraph/src/jpgraph_text.inc.php");
  require_once("../database.php");
  $db = new Database();
  $id = $_GET['id'];

  /******************
  * File Data
  ******************/
  $filePath = "../../phase_2/files/test/$id/dataAnalysis.csv";
  $file = fopen($filePath, "r") or die($filePath);
  $line1 = fgetcsv($file);
  //  $avgX [ SENSOR CHANNEL ] [ ENTRY ]
  $avgChan = array();
  $avgX    = array();
  $avgY    = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    $avgChan[$i] = $temp[0];
    $avgTemp[$i] = (double) $temp[1];
    $avgTime[$i] = (double) $temp[2];
    $i++;
  }
  fclose($file);


  /******************
  * Graph Setup
  ******************/
  $graph = new Graph(1200, 1200);
  $graph->SetScale('linlin', 0, 60, 0, 21);
  $graph->SetColor('lightblue');
  $graph->SetMarginColor('#F9DAC6');

  //  Setup Title
  $graph->title->Set("Averaged Temps");
  $graph->title->SetFont(FF_FONT2, FS_BOLD);
  $graph->SetColor('#191919');

  // Setup X-Axis
  $graph->xaxis->SetTickLabels($avgChan);
  $graph->xaxis->scale->ticks->Set(3);
  $graph->xaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetLabelMargin(15);
  $graph->xaxis->SetTitle("Channel", center);
  $graph->xaxis->SetTitleMargin(30);
  $graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetWeight(3);
  $graph->xaxis->title->SetColor('#191919');

  // Setup Y-Axis
  $graph->yaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetLabelMargin(15);
  $graph->yaxis->SetTitle("Temp", middle);
  $graph->yaxis->SetTitleMargin(55);
  $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetWeight(3);
  $graph->yaxis->title->SetColor('#191919');

  $graph->img->SetMargin(50,50,50,50);
  $graph->SetMargin(80,30,30,70);
  $graph->SetFrame(true,'black',1);


  $lastElement = sizeof($avgTemp) - 1;
  if ($avgTemp[$lastElement] == 0 && $avgTime[$lastElement] == 0) {
    array_pop($avgTemp);
    array_pop($avgTime);
    array_pop($avgChan);
  }

  $xaxis = array();
  for ($i = 0; $i < sizeof($avgTemp); $i++) {
    $point = (int) ($i / 3);
    if ($point > 0 )  $point*=3;
    $xaxis[$i] = $point;
  }

  $color = '#EC8888';
  $scatter = new ScatterPlot($avgTemp, $xaxis);
  $scatter->mark->SetType(MARK_FILLEDCIRCLE);
  $scatter->mark->SetSize(10);
  $scatter->mark->SetFillColor($color);
  // $scatter->mark->SetColor($color);

  for ($i = 0; $i < sizeof($avgTemp); $i++) {
    $txt[$i] = new Text();
    $txt[$i]->Set($avgTime[$i]);
    $txt[$i]->SetScalePos($xaxis[$i], $avgTemp[$i]);
    $txt[$i]->Align("center", "center");
    $txt[$i]->SetFont(FF_FONT1, FS_BOLD);
    // $graph->Add($txt[$i]);
  }

  $graph->Add($scatter);

  $graph->Stroke();


?>
