<?php
/***
  *
  * Graphs the average thickness of sheets3 of both 3 and 8 ply with respect to date
  *
  */
  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_scatter.php");
  require_once("../jpgraph/src/jpgraph_date.php");
  require_once("../database.php");
  $db = new Database();
  $sheets3 = $db->db_query("SELECT avgThickness, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=3");
  $sheets8 = $db->db_query("SELECT avgThickness, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=8");

  // Graph Data
  $dataY3 = array();
  $dataX3 = array();
  for ($i = 0; $i < sizeof($sheets3); $i++) {
    if ($sheets3[$i]['avgThickness'] == "") {
      $dataY3[$i] = (($sheets3[$i]['thickness1'] + $sheets3[$i]['thickness2'] + $sheets3[$i]['thickness3'] + $sheets3[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY3[$i] = $sheets3[$i]['avgThickness'] * 1000;
    }
    $dataX3[$i] = strtotime($sheets3[$i]['dateCut']); // Convert YYYY-MM-DD to Unix Timeshamp
  }
  $dataY8 = array();
  $dataX8 = array();
  for ($i = 0; $i < sizeof($sheets8); $i++){
    if ($sheets8[$i]['avgThickness'] == null) {
      $dataY8[$i] = (($sheets8[$i]['thickness1'] + $sheets8[$i]['thickness2'] + $sheets8[$i]['thickness3'] + $sheets8[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY8[$i] = $sheets8[$i]['avgThickness'] * 1000;
    }
    $dataX8[$i] = strtotime($sheets8[$i]['dateCut']); // Convert YYYY-MM-DD to Unix Timeshamp
  }

  $low = $high = $dataY8[0];
  for ($i = 1; $i < sizeof($dataY3); $i++) {
    if ($low > $dataY3[$i]) {
      $low = $dataY3[$i];
    } else if ($high < $dataY3[$i]) {
      $high = $dataY3[$i];
    }
  }
  $l = $h = $dataY8[0];
  for ($i = 1; $i < sizeof($dataY8); $i++) {
    if ($l > $dataY8[$i]) {
      $l = $dataY8[$i];
    } else if ($h < $dataY8[$i]) {
      $h = $dataY8[$i];
    }
  }

  if ($l < $low) $low = $l;
  if ($h > $high) $high = $h;

  if ($low - 100 < 0)
    $low = 0;
  else $low -= 100;
  $high += 250;

  $max = $min = $dataX3[0];
  for ($i = 0; $i < sizeof($dataX3); $i++) {
    if ($min > $dataX3[$i]) {
      $min = $dataX3[$i];
    } elseif ($max < $dataX3[$i]) {
      $max = $dataX3[$i];
    }
  }

  $ma = $mi = $dataX8[0];
  for ($i = 1; $i < sizeof($dataX8); $i++) {
    if ($mi > $dataX8[$i]) {
      $mi = $dataX8[$i];
    } else if ($ma < $dataX8) {
      $ma = $dataX8[$i];
    }
  }

  if ($mi < $min) $min = $mi;
  if ($ma > $max) $max = $ma;

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

  // Setup ticks xaxis
  $graph->xaxis->scale->SetTimeAlign(DAYADJ_1); // Marks are ar the start of every day
  $graph->xaxis->scale->ticks->Set(60*60*24*7); // ticks once every week
  $graph->xaxis->scale->SetDateFormat('m-d-Y'); //MM-DD-YYYY format

  // Setup tick yaxis
  $graph->yaxis->scale->ticks->Set(50);

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

  // Setup Scatter Plot for 3 ply
  $scatter3 = new ScatterPlot($dataY3, $dataX3);
  $scatter3->mark->SetType(MARK_FILLEDCIRCLE);
  $scatter3->mark->SetSize(14);
  $scatter3->mark->SetFillColor(red);
  $graph->Add($scatter3);

  // Setup Scatter Plot for 8 ply
  $scatter8 = new ScatterPlot($dataY8, $dataX8);
  $scatter8->mark->SetType(MARK_FILLEDCIRCLE);
  $scatter8->mark->SetSize(14);
  $scatter8->mark->SetFillColor(blue);
  $graph->Add($scatter8);

  $graph->Stroke();
?>
