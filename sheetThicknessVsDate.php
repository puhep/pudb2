<?php
/***
  *
  * Graphs the average thickness of sheets of ply 3 with respect to date
  *
  */

  require_once("./jpgraph/src/jpgraph.php");
  require_once("./jpgraph/src/jpgraph_scatter.php");
  require_once("./jpgraph/src/jpgraph_date.php");
  require_once("./jpgraph/src/jpgraph_line.php");
  require_once("database.php");
  require_once("functions.php");
  $db = new Database();
  $sheets = db_query("SELECT thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=3", $db);

//  print_r($sheets);

  // Setup Graph
  $graph = new Graph(1248, 1000);
  $graph->SetScale("datlin");
  $graph->SetColor('lightblue');
  $graph->SetMarginColor('#F9DAC6');
  $graph->img->SetMargin(50,50,50,50);
  $graph->img->SetAntiAliasing(false);
  $graph->SetMargin(70,80,30,125);
  $graph->SetFrame(true, 'black', 0);

  // Setup ticks
  $graph->xaxis->scale->SetTimeAlign(DAYADJ_1); // Marks are ar the start of every day
  $graph->xaxis->scale->ticks->Set(60*60*24*7); // ticks once every week
  $graph->xaxis->scale->SetDateFormat('m-d-Y'); //MM-DD-YYYY format


  // Setup Title
  $graph->title->Set("Thickness Over Date of Curing");
  $graph->title->SetFont(FF_FONT2, FS_BOLD);
  $graph->title->SetColor('#191919');

  // Setup X-Axis
  $graph->xaxis->SetLabelAngle(90);
  $graph->xaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetLabelMargin(10);
  $graph->xaxis->SetTitle("Date", center);
  $graph->xaxis->SetTitleMargin(83);
  $graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetWeight(3);
  $graph->xaxis->title->SetColor('#191919');
  //$graph->xaxis->scale->ticks->Set(30); // Line crashes the Graph

  // Setup Y-Axis
  $graph->yaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetLabelMargin(10);
  $graph->yaxis->SetTitle("Sheet Thickness", middle);
  $graph->yaxis->SetTitleMargin(50);
  $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetWeight(3);
  $graph->yaxis->title->SetColor('#191919');

  $dataY = array();
  $dataX = array();
  for ($i = 0; $i < sizeof($sheets); $i++) {
    $dataY[$i] = ($sheets[$i]['thickness1'] + $sheets[$i]['thickness2'] + $sheets[$i]['thickness3'] + $sheets[$i]['thickness4']) / 4; // Avevrage Thickness
    $dataX[$i] = strtotime($sheets[$i]['dateCut']); // Convert YYYY-MM-DD to Unix Timeshamp
  }

  // Setup Scatter Plot
  $scatter = new ScatterPlot($dataY, $dataX);
  $scatter->mark->SetType(MARK_FILLEDCIRCLE);
  $scatter->mark->SetSize(14);
  $scatter->mark->SetFillColor(red);

  $graph->Add($scatter);
  $graph->Stroke();
?>