<?php
/***
  *
  * Graphs the average thickness of sheets of ply 8 with respect to date
  *
  */

  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_scatter.php");
  require_once("../jpgraph/src/jpgraph_date.php");
  require_once("../database.php");
  $db = new Database();
  $sheets = $db->db_query("SELECT avgThickness, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=8");

  // Graph Data
  $dataY = array();
  $dataX = array();
  for ($i = 0; $i < sizeof($sheets); $i++) {
    if ($sheets[$i]['avgThickness'] == "") {
      $dataY[$i] = (($sheets[$i]['thickness1'] + $sheets[$i]['thickness2'] + $sheets[$i]['thickness3'] + $sheets[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY[$i] = $sheets[$i]['avgThickness'] * 1000;
    }
    $dataX[$i] = strtotime($sheets[$i]['dateCut']); // Convert YYYY-MM-DD to Unix Timeshamp
  }

  $low = $high = $dataY[0];
  for ($i = 1; $i < sizeof($dataX); $i++) {
    if ($low > $dataY[$i]) {
      $low = $dataY[$i];
    } else if ($high < $dataY[$i]) {
      $high = $dataY[$i];
    }
  }
  if ($low - 100 < 0)
    $low = 0;
  else $low -= 100;
  $high += 250;

  $max = $min = $dataX[0];
  for ($i = 1; $i < sizeof($dataX); $i++) {
    if ($min > $dataX[$i]) {
      $min = $dataX[$i];
    } elseif ($max < $dataX[$i]) {
      $max = $dataX[$i];
    }
  }

  $min -= 60*60*24*7; // Seconds in a week
  $max += 60*60*24*7;
  // Setup Graph
  $graph = new Graph(1248, 1000);
  $graph->SetScale("datlin", $low, $high, $min, $max);
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
  // $mu = SymChar::Get('mu');
  $graph->yaxis->title->Set("Sheet Thickness (microns)");
  $graph->yaxis->SetTitleMargin(50);
  $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetWeight(3);
  $graph->yaxis->title->SetColor('#191919');

  // Setup Scatter Plot
  $scatter = new ScatterPlot($dataY, $dataX);
  $scatter->mark->SetType(MARK_FILLEDCIRCLE);
  $scatter->mark->SetSize(14);
  $scatter->mark->SetFillColor(blue);

  $graph->Add($scatter);
  $graph->Stroke();
?>
