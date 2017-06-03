<?php
  require_once("./jpgraph/src/jpgraph.php");
  require_once("./jpgraph/src/jpgraph_scatter.php");
  require_once("./jpgraph/src/jpgraph_line.php");
  require_once("database.php");

  $id=$_GET['id'];
  ### display the temperature versus time for all sensors using the test file

  #echo file_get_contents("test.txt");
  $filePath = "../phase_2/files/test/$id/tempVsTime.csv";
  $file = fopen($filePath,"r") or die($filePath);
//  $file = fopen("CFthermalconductivity_test1.csv","r") or die("Unable to open file!");
  $line1 = fgetcsv($file);
  $numSensors = (count($line1)-1)/2;
  $sensorName = array();
  $j = 0;
  for ($i = 1; $i < sizeof($line1); $i += 2) {
    $sensorName[$j++] = $line1[$i];
  }

  $noOfLines = count(file($filePath));
  $sensor = array_fill(0, $numSensors, array_fill(0,$noOfLines-1,array_fill(0, 2, 0)));
  while (!feof($file)) {
    $temp = fgetcsv($file);
    for ($i = 1; $i < $numSensors*2; $i += 2) {
      $sensorsNum = ($i-1)/2;
      $entry = $temp[0]-1;
      $x = 0;
      $y = 1;
      $sensor[$sensorsNum][$entry][$x] = $temp[$i];
      $sensor[$sensorsNum][$entry][$y] = $temp[$i+1];
    }
  }
  // Done With file
  fclose($file);

  // Setup Graph
  $graph = new Graph(1200, 1200);
  $graph->SetScale('linlin', 20, 60,0,0);
  $graph->SetColor('lightblue');
  $graph->SetMarginColor('#F9DAC6');

  // Setup Title
  $graph->title->Set("Temp Over Time");
  $graph->title->SetFont(FF_FONT2, FS_BOLD);
  $graph->title->SetColor('#191919');

  // Setup X-Axis
  $graph->xaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetLabelMargin(15);
  $graph->xaxis->SetTitle("Time", center);
  $graph->xaxis->SetTitleMargin(30);
  $graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->xaxis->SetWeight(3);
  $graph->xaxis->title->SetColor('#191919');

  // Setup Y-axis
  $graph->yaxis->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetLabelMargin(15);
  $graph->yaxis->SetTitle("Temp", middle);
  $graph->yaxis->SetTitleMargin(55);
  $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
  $graph->yaxis->SetWeight(3);
  $graph->yaxis->title->SetColor('#191919');

  $graph->img->SetMargin(50,50,50,50);
  $graph->SetMargin(80,30,30,20);
  $graph->SetFrame(true,'black',1);

  // Create an array of Scatterplots
  $scatter = array();
  for ($i = 0; $i < $numSensors; $i++) {
    $dataX = array();
    $dataY = array();

    // Add all x point of a sensor to $dataX and the same for y
    for ($j = 0; $j < $noOfLines; $j++) {
      $dataY[$j] = (float) $sensor[$i][$j][0];
      $dataX[$j] = (float) $sensor[$i][$j][1];
    }

    // Create scatterplots with the newly parsed data
    $scatter[$i] = new ScatterPlot($dataY, $dataX);
    $scatter[$i]->mark->SetType(MARK_FILLEDCIRCLE);
    $scatter[$i]->mark->SetSize(2);
    $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    $scatter[$i]->mark->SetFillColor($color);
    $scatter[$i]->mark->SetColor($color);
    $scatter[$i]->SetLegend(substr($sensorName[$i], 0, 5));
    // echo $sensorsName[$i]."<br>";
    // Add the scatterplot to the graph
    $graph->Add($scatter[$i]);
  }

  // Setup graph legend
  $graph->legend->SetPos(0.5, 0.90, 'center', 'bottom');
  $graph->legend->SetFont(FF_FONT2, FS_BOLD);
  $graph->legend->SetFrameWeight(2);
  $graph->legend->SetMarkAbsSize(10);
  $graph->legend->SetShadow();


  $graph->Stroke();
?>
