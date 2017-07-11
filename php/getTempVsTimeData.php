<?php
  require_once("../database.php");
  $db = new Database();
  $id=$_GET['id'];

  // Query the database to get the sensor names and channel
  $sql = "SELECT s.name as sensorName, st.channel as sensorChannel
            FROM test t
            LEFT JOIN sensor_test st ON st.test_id=t.id
            LEFT JOIN thermal_sensor s ON st.thermal_id=s.id
            WHERE t.id=".$id;
  $result = $db->db_query($sql);

  ### display the temperature versus time for all sensors using the test file

  #echo file_get_contents("test.txt");
  $filePath = "../../phase_2/files/test/$id/tempVsTime.csv";
  $file = fopen($filePath,"r") or die($filePath);
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

  $text = array();
  for ($i = 0; $i < $numSensors; $i++) {
    $channel = substr($sensorName[$i], 0, 5);
    $temp    = substr($sensorName[$i], 2, 3);
    for ($j = 0; $j < sizeof($result); $j++) {
      if ($temp == $result[$j]['sensorChannel']) {
        $channel = $result[$j]['sensorName']." - ".$channel;
      }
    }
    array_push($text, $channel);
  }
  /******************
  * Some analysis
  ******************/
  // Create a new file everytime the page is loaded. Incase of change
  // Not the right thing to do but it works.
  $filePath = "../../phase_2/files/test/$id/dataAnalysis.csv";
  $file = fopen($filePath, "w");
  chmod($filePath,0777);
  fwrite($file, "Sensor,");
  fwrite($file, "avgTemp,");
  fwrite($file, "avgTime,");
  fwrite($file, "size\n");
  fclose($file);  // Close file
  $size = array();
  for ($z = 0; $z <= $sensorsNum; $z++) {
    $startFlatX = array();
    $startFlatY = array();
    $endFlatX   = array();
    $endFlatY   = array();
    $avgX       = array();
    $avgY       = array();
    $j = $k = $sumX = $sumY =  0; // Used to count how many are flat
    for ($i = 0; $i < sizeof($sensor[$z]) - 1; $i++) {
      $slope = (double)(($sensor[$z][$i][$x] - $sensor[$z][$i + 1][$x]) / ($sensor[$z][$i][$y] - $sensor[$z][$i + 1][$y]));
      $slope = abs($slope);
      if ($slope < 0.1) { // 0.006 is the current measure if it is 'flat'
        if ($j == 0) {
          $startFlatX[$k] = $sensor[$z][$i][$x];
          // echo "<br>start::: ".$startFlatX[$k]."<br>";
          $startFlatY[$k] = $sensor[$z][$i][$y];
        }
        $j++;
        $sumX += $sensor[$z][$i][$x];
        $sumY += $sensor[$z][$i][$y];
      } else if ($j > 100) {
        $endFlatX[$k] = $sensor[$z][$i][$x];
        // echo "<br>end::: ".$endFlatX[$k]."<br>";
        $endFlatY[$k] = $sensor[$z][$i][$y];
        $avgX[$k] = $sumX / $j;
        $avgY[$k] = $sumY / $j;
        $size[$k] = $j;
        $k++;
        // echo "<br>J::: ".$j."<br>";
        $j = 0;
      } else {
        // echo "<br>removed<br>";
        $startFlatX[$k] = null;
        $startFlatY[$k] = null;
        $j = $sumX = $sumY = 0;
      }
    }
    if ($startFlatX[sizeof($startFlatX)-1] == null && $startFlatY[sizeof($startFlatY)-1] == null) {
      array_pop($startFlatX);
      array_pop($startFlatY);
    }
    //  Add the last point to endFlat if there is not one
    if (sizeof($startFlatX) > sizeof($endFlatX) && sizeof($startFlatY) > sizeof($endFlatY)) {
      $xVal = $sensor[$z][sizeof($sensor[$z])-2][$x];
      $yVal = $sensor[$z][sizeof($sensor[$z])-2][$y];
      if ($xYal == $startFlatX[sizeof($startFlatX)-2] && $yVal == $startFlatY[sizeof($startFlatY)-2]) {
        array_pop($startFlatX);
        array_pop($startFlatY);
      } else {
        $endFlatX[$k] = $xVal;
        $endFlatY[$k++] = $yVal;
      }
    }

    /**********************************
    * CREATE FILE FOR MORE ANALYSIS
    **********************************/
    $file = fopen($filePath, "a");
    for ($q = 0; $q < sizeof($avgX); $q++) {
      $channel = substr($sensorName[$q], 0, 5);
      $temp    = substr($sensorName[$q], 2, 3);
      for ($j = 0; $j < sizeof($result); $j++) {
        if ($temp == $result[$j]['sensorChannel']) {
          $channel = $result[$j]['sensorName']." - ".$channel;
        }
      }
      $line = $channel.",".$avgX[$q].",".$avgY[$q].",".$size[$q]."\n";
      fwrite($file, $line);
    } // end of for loop; addes lines to end of file
    fclose($file);  //  Close file
  } // end of for loop; goes thur all sensors

  /******************
  * RETURN
  ******************/
  $size = sizeof($sensor[0]) - 1;
  if ($text[sizeof($text)-1] == false) array_pop($text);
  $return = new stdClass();
  $return->text = $text;
  $return->sensor = $sensor;
  $return->size = $size;
  $json = json_encode($return);
  echo $json;
?>
