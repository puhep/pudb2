<?php
  /******************
  * REQUIRE
  ******************/
  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_scatter.php");
  require_once("../database.php");
  require_once("../functions.php");
  $db = new Database();
  $id = $_GET['id'];

  $sensorData = sensorTestData($id,$db);
  $heaterData = heaterTestData($id,$db);
  $moduleData = moduleTestData($id,$db);

  /******************
  * GET GRAPH DATA
  ******************/

  $i = 0;
  foreach ($sensorData as $line) {
    if ($line['sensorXPos'] != '' && $line['sensorYPos'] != '') {
      $sx[$i]      = $line['sensorXPos'];
      $sy[$i]      = $line['sensorYPos'];
      $sname[$i++] = $line['sensorName'];
    }
  }
  $i = 0;
  foreach ($heaterData as $line) {
    if ($line['heaterXPos'] != '' && $line['heaterYPos'] != '') {
      $heater      = 1;
      $hx[$i]      = $line['heaterXPos'];
      $hy[$i]      = $line['heaterYPos'];
      $hname[$i++] = $line['heaterName'];
    }
  }
  $i = 0;
  foreach ($moduleData as $line) {
    if ($line['moduleXPos'] != '' && $line['moduleYPos'] != '') {
      $module      = 1;
      $mx[$i]      = $line['moduleXPos'];
      $my[$i]      = $line['moduleYPos'];
      $mname[$i++] = $line['moduleName'];
    }
  }
  /******************
  * SETUP GRAPH
  ******************/
  $graph = new Graph(900, 600);
  $graph->SetScale("linlin", -1, 7, -1, 20);
  $graph->SetFrame(true, 'blue', 1);
  $graph->SetColor('white');
  $graph->SetMarginColor('#F9DAC6');

  /******************
  * SETUP TITLE
  ******************/
  $graph->title->Set("Geometry");
  $graph->title->SetFont(FF_FONT2,FS_BOLD);
  $graph->title->SetColor("#191919");

  $graph->yaxis->SetFont(FF_FONT1,FS_BOLD);
  $graph->yaxis->SetLabelMargin(15);
  $graph->xaxis->SetFont(FF_FONT1,FS_BOLD);
  $graph->xaxis->SetLabelMargin(15);

  $axisWeight = 3;

  /******************
  * Setup X-axis label
  ******************/
  $graph->xaxis->SetTitle("X (cm)", center);
  $graph->xaxis->SetTitleMargin(20);
  $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
  $graph->xaxis->SetWeight($axisWeight);
  $graph->xaxis->title->SetColor("#191919");
  $graph->xaxis->scale->ticks->Set(1);

  /******************
  * SETUP Y-axis label
  ******************/
  $graph->yaxis->SetTitle("Y (cm)", middle);
  $graph->yaxis->SetTitleMargin(45);
  $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
  $graph->yaxis->SetWeight($axisWeight);
  $graph->yaxis->title->SetColor("#191919");

  $graph->img->SetMargin(50,50,50,50);
  $graph->SetMargin(70,20,50,60);
  $graph->SetFrame(true,'black',1);

  /******************
  * SETUP area to represent the aluminum
  ******************/
  $aluminumColor = 'honeydew';
  $alumY = array(3.74, 3.74, 3.74, 2.3, 2.3, 2.3);
  $alumX = array(4.26, 14.5, 14.8, 4.26, 14.5, 14.8);
  $alum = new Scatterplot($alumY, $alumX);
  $alum->mark->SetType(MARK_SQUARE);
  $alum->mark->SetSize(400);
  $alum->mark->SetFillColor($aluminumColor);
  $alum->mark->SetColor($aluminumColor);
  $graph->Add($alum);

  /******************
  * Setup grey areas to represent the wing
  ******************/
  $wingColor = 'dimgray';
  $wingY = array(1.64, 3.8, 4.35, 1.64, 3.8, 4.35, 1.64, 3.8, 4.35, 1.64, 3.8, 4.35);
  $wingX = array(2.57, 2.57, 2.57, 7.4, 7.4, 7.4, 12.38, 12.38, 12.38, 12.4,12.4,12.4);
  $wing = new Scatterplot($wingY, $wingX);
  $wing->mark->SetType(MARK_SQUARE);
  $wing->mark->SetSize(200);
  $wing->mark->SetFillColor($wingColor);
  $wing->mark->SetColor($wingColor);
  $graph->Add($wing);

  if (count($mx)) {
    $sp3 = new Scatterplot($my,$mx);
    $sp3->mark->SetType(MARK_SQUARE);
    $sp3->mark->SetSize(50);
    $sp3->mark->SetFillColor("purple");

    $i=0;
    foreach ($mname as $point) {
      $txt[$i] = new Text();
      $txt[$i]->Set($point);
      $txt[$i]->SetScalePos($mx[$i],$my[$i]);
      $txt[$i]->Align("center","center");
      $txt[$i]->SetFont(FF_FONT1,FS_BOLD);
      $graph->Add($txt[$i]);
      $i++;
    }
    $graph->Add($sp3);
  }

  if (count($sx)) {
    $sp1 = new Scatterplot($sy,$sx);
    $sp1->mark->SetType(MARK_FILLEDCIRCLE);
    $sp1->mark->SetSize(14);
    $sp1->mark->SetFillColor(yellow);

    $i=0;
    foreach ($sname as $point) {
      $txt[$i] = new Text();
      $txt[$i]->Set($point);
      $txt[$i]->SetScalePos($sx[$i],$sy[$i]);
      $txt[$i]->Align("center","center");
      $txt[$i]->SetFont(FF_FONT1,FS_BOLD);
      $graph->Add($txt[$i]);
      $i++;
    }
    $graph->Add($sp1);
  }

  if (count($hx)) {
    $sp2 = new Scatterplot($hy,$hx);
    $sp2->mark->SetType(MARK_FILLEDCIRCLE);
    $sp2->mark->SetSize(14);
    $sp2->mark->SetFillColor("red");

    $i=0;
    foreach ($hname as $point) {
      $txt[$i] = new Text();
      $txt[$i]->Set($point);
      $txt[$i]->SetScalePos($hx[$i],$hy[$i]);
      $txt[$i]->Align("center","center");
      $txt[$i]->SetFont(FF_FONT1,FS_BOLD);
      $graph->Add($txt[$i]);
      $i++;
    }
    $graph->Add($sp2);
  }
  $graph->Stroke();

?>
