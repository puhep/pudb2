<?php

  /*****************************************************************************
  *
  *  @ToDo: Check out issue #23
  *
  *  @ToDo: Possible, automatically create a file that holds the average
  *  of the 'flat' areas
  *
  *  Green and Red dots indicate that start and end of 'flat' sections
  *  respectivly.
  *
  *  Yellow dot indicate the average of the 'flat' sections
  *
  *****************************************************************************/

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
  $x = 1;
  $y = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    for ($i = 1; $i < $numSensors*2; $i += 2) {
      $sensorsNum = ($i-1)/2;
      $entry = $temp[0]-1;
      $sensor[$sensorsNum][$entry][$x] = $temp[$i];
      $sensor[$sensorsNum][$entry][$y] = $temp[$i+1];
    }
  }
  fclose($file);  // Done With file

  // Setup Graph
  $graph = new Graph(1200, 1200);
  $graph->SetScale('linlin', 0, 60,0,0);
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
      $dataY[$j] = (float) $sensor[$i][$j][$x];
      $dataX[$j] = (float) $sensor[$i][$j][$y];
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

  /*****************
  * Some analysis
  *****************/
  for ($z = 0; $z <= $sensorsNum; $z++) {
    $startFlatX = array();
    $startFlatY = array();
    $endFlatX   = array();
    $endFlatY   = array();
    $avgX       = array();
    $avgY       = array();
    $j = $k = $sumX = $sumY =  0; // Used to count how many are flat
    for ($i = 0; $i < sizeof($sensor[$z]) - 1; $i++) {
      $slope = ($sensor[$z][$i][$x] - $sensor[$z][$i + 1][$x]) / ($sensor[$z][$i][$y] - $sensor[$z][$i + 1][$y]);
      $slope = abs($slope);
      if ($slope < 0.006) { // 0.006 is the current measure if it is 'flat'
        if ($j == 0) {
          $startFlatX[$k] = $sensor[$z][$i][$x];
          $startFlatY[$k] = $sensor[$z][$i][$y];
        }
        $j++;
        $sumX += $sensor[$z][$i][$x];
        $sumY += $sensor[$z][$i][$y];
      } else if ($j > 100) {
        $endFlatX[$k] = $sensor[$z][$i][$x];
        $endFlatY[$k] = $sensor[$z][$i][$y];
        $avgX[$k] = $sumX / $j;
        $avgY[$k] = $sumY / $j;
        $k++;
        $j = 0;
      } else {
        $j = $sumX = $sumY = 0;
      }
    }
    //  Add the last point to endFlat if there is not one
    if (sizeof($startFlatX) > sizeof($endFlatX) && sizeof($startFlatY) > sizeof($endFlatY)) {
      $endFlatX[$k] = $sensor[$z][sizeof($$sensor[$z]-2)][$x];
      $endFlatY[$k++] = $sensor[$z][sizeof($$sensor[$z]-2)][$y];
    }
    $avg = new ScatterPlot($avgX, $avgY); //  Average point in flat regions
    $avg->mark->SetType(MARK_FILLEDCIRCLE);
    $avg->mark->SetSize(14);
    $avg->mark->SetFillColor(yellow);
    $avg->mark->SetColor(yellow);
    $flatStart = new ScatterPlot($startFlatX, $startFlatY); // Start of flat regions
    $flatStart->mark->SetType(MARK_FILLEDCIRCLE);
    $flatStart->mark->SetSize(14);
    $flatStart->mark->SetFillColor(green);
    $flatStart->mark->SetColor(green);
    $flatEnd = new ScatterPlot($endFlatX, $endFlatY); //  End of flat regions
    $flatEnd->mark->SetType(MARK_FILLEDCIRCLE);
    $flatEnd->mark->SetSize(14);
    $flatEnd->mark->SetFillColor(red);
    $flatEnd->mark->SetColor(red);

    $graph->Add($avg);
    $graph->Add($flatStart);
    $graph->Add($flatEnd);
  }

  $graph->Stroke(); //  Show the graph
?>
