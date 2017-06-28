<?php
  require_once("../database.php");
  require_once("../functions.php");
  $id = $_GET['id'];
  $filePath = "../../phase_2/files/test/$id/dataAnalysis.csv";
  $file = fopen($filePath, "r");
  $line1 = fgetcsv($file);
  $avgChan = array();
  $avgX    = array();
  $avgY    = array();
  $size    = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    $avgChan[$i] = $temp[0];
    $avgTemp[$i] = (double) $temp[1];
    $avgTime[$i] = (double) $temp[2];
    $size[$i]    = (double) $temp[3];
    $i++;
  }
  fclose($file);

  $lastElement = sizeof($avgTemp) - 1;
  if ($avgTemp[$lastElement] == 0 && $avgTime[$lastElement] == 0) {
    array_pop($avgTemp);
    array_pop($avgTime);
    array_pop($avgChan);
    array_pop($size);
  }
  /******************
  * DATA ANALYSIS
  ******************/
  $errMax = array();
  $errMin = array();
  for ($i = 0; $i < sizeof($avgTemp); $i++) {
    $tempError = (double)(sqrt($size[$i]) / 100 * $avgTemp[$i]);
    $errMax[$i] = $avgTemp[$i] + $tempError;
    $errMin[$i] = $avgTemp[$i] - $tempError;
  }

  /******************
  * SEND DATA
  ******************/
  $return = new stdClass;
  $return->avgChan = $avgChan;
  $return->avgTime = $avgTime;
  $return->avgTemp = $avgTemp;
  $return->size    = $size;
  $return->errMax  = $errMax;
  $return->errMin  = $errMin;
  $json = json_encode($return);
  echo $json;
?>
