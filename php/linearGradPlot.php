<?php
  ### display the geometry of a test's sensors using a plot
  require_once("../jpgraph/src/jpgraph.php");
  require_once("../jpgraph/src/jpgraph_scatter.php");
  require_once("../database.php");
  require_once("../functions.php");
  $db = new Database();
  $id=$_GET['id'];

  $sensorData = sensorTestData($id,$db);
  $heaterData = heaterTestData($id,$db);
  $moduleData = moduleTestData($id,$db);

  $i=0;
  foreach($sensorData as $line){
    if($line['sensorXPos'] !='' and $line['sensorYPos'] !=''){
      $sx[$i]=$line['sensorXPos'];
      $sy[$i]=$line['sensorYPos'];
      $sname[$i]=$line['sensorName'];
      $i++;
    }
  }
  $i=0;
  foreach($heaterData as $line){
    if($line['heaterXPos'] !='' and $line['heaterYPos'] !=''){
      $heater=1;
      $hx[$i]=$line['heaterXPos'];
      $hy[$i]=$line['heaterYPos'];
      $hname[$i]=$line['heaterName'];
      $i++;
    }
  }
  $i=0;
  foreach($moduleData as $line){
    if($line['moduleXPos'] !='' and $line['moduleYPos'] !=''){
      $module=1;
      $mx[$i]=$line['moduleXPos'];
      $my[$i]=$line['moduleYPos'];
      $mname[$i]=$line['moduleName'];
      $i++;
    }
  }

  // Setup Graph
  $g = new Graph(900,600);
  $g->SetScale("linlin",0,10,0,15);
  $g->SetFrame(true,'blue',1);
  $g->SetColor('white');
  $g->SetMarginColor('#F9DAC6');

  // Setup Title
  $g->title->Set("Test ".$data[0]['tname']." Geometry");
  $g->title->SetFont(FF_FONT2,FS_BOLD);
  $g->title->SetColor("#191919");

  $g->yaxis->SetFont(FF_FONT1,FS_BOLD);
  $g->yaxis->SetLabelMargin(15);
  $g->xaxis->SetFont(FF_FONT1,FS_BOLD);
  $g->xaxis->SetLabelMargin(15);

  $axisWeight = 3;

  // Setup X-axis label
  $g->xaxis->SetTitle("X (cm)", center);
  $g->xaxis->SetTitleMargin(15);
  $g->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
  $g->xaxis->SetWeight($axisWeight);
  $g->xaxis->title->SetColor("#191919");

  // Setup Y-axis label
  $g->yaxis->SetTitle("Y (cm)", middle);
  $g->yaxis->SetTitleMargin(30);
  $g->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
  $g->yaxis->SetWeight($axisWeight);
  $g->yaxis->title->SetColor("#191919");

  $g->img->SetMargin(50,50,50,50);
  $g->SetMargin(50,50,50,50);
  $g->SetFrame(true,'black',1);

  // Setup black areas to represent the wings
  $wingColor = 'gray4';
  $wingY = array(7.4,2.6,7.4,2.6,7.4,2.6,7.4,2.6,);
  $wingX = array(2.37,2.37,5,5,12.6,12.6,8,8);
  $wing = new Scatterplot($wingY, $wingX);
  $wing->mark->SetType(MARK_SQUARE);
  $wing->mark->SetSize(255);
  $wing->mark->SetFillColor($wingColor);
  $wing->mark->SetColor($wingColor);
  $g->Add($wing);

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
      $g->Add($txt[$i]);
      $i++;
    }
    $g->Add($sp3);
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
      $g->Add($txt[$i]);
      $i++;
    }
    $g->Add($sp1);
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
      $g->Add($txt[$i]);
      $i++;
    }
    $g->Add($sp2);
  }
  $g->Stroke();
?>
