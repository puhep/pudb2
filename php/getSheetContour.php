<?php
  /*******************
  * REQUIRE
  *******************/
  require_once("../database.php");
  require_once("../functions.php");
  /*******************
  * READ FILE
  *******************/
  $db = new Database();
  $id = $_GET['id'];
  $filePath = "../../phase_2/files/sheet/$id/ThicknessContour.csv";
  $file = fopen($filePath, "r") or die("<h1>Some thing went wrong.</h1><h2>Could not find file.</h2>");
  // Temp is not temperature but temporary
  $xTemp = array();
  $yTemp = array();
  $zTemp = array();
  $i = 0;
  // reads the file and and puts the x, y, and z values into the temp array
  while (!feof($file)) {
    $temp = fgetcsv($file);
    $xTemp[$i]   = (double) $temp[0];
    $yTemp[$i]   = (double) $temp[1];
    $zTemp[$i++] = (double) $temp[2];
  }

  fclose($file); // save memory, close file

  // min and max values
  $maxX = $xTemp[0];
  $minX = $xTemp[0];
  $maxY = $yTemp[0];
  $minY = $yTemp[0];
  // Traverse the array and find the largest/smallest x and y values
  for ($i = 1; $i < sizeof($xTemp) - 1; $i++) {
    if ($maxX < $xTemp[$i]) {
      $maxX = $xTemp[$i];
    } else if ($minX > $xTemp[$i]) {
      $minX = $xTemp[$i];
    }
    if ($maxY < $yTemp[$i]) {
      $maxY = $yTemp[$i];
    } else if ($minY > $yTemp[$i]) {
      $minY = $yTemp[$i];
    }
  }
  // permanent array of x, y, and z positions
  $x = array();
  $y = array();
  $z = array();
  $j = 0; // Temp position of permanent array
  // Traverse the temp arrays and any value at the min or the max don't add to the permanent array
  for ($i = 0; $i < sizeof($xTemp); $i++) {
    if ($xTemp[$i] > $minX + 1 && $xTemp[$i] < $maxX - 1 && $yTemp[$i] > $minY + 1 && $yTemp[$i] < $maxY - 1) {
      $x[$j] = $xTemp[$i];
      $y[$j] = $yTemp[$i];
      $z[$j++] = $zTemp[$i];
    }
  }
  /******************
  * UPDATE THICKNESS
  ******************/
  $sum = $z[0];
  $min = $z[0];
  $max = $z[0];
  for ($i = 1; $i < sizeof($z)-1; $i++) {
    $sum += $z[$i];
    if ($min > $z[$i]) {
      $min = $z[$i];
    } else if ($max < $z[$i]) {
      $max = $z[$i];
    }
  }
  $avg = $sum / $i;

  $sql = "SELECT avgThickness FROM sheet WHERE id=$id";
  $data = $db->db_query($sql);
  $data = $data[0];
  $avgThick = $data['avgThickness'];
  $sql = "UPDATE sheet SET avgThickness=\"$avg\" WHERE id=$id";
  $db->query($sql);
  $sql = "UPDATE sheet SET minThickness=\"$min\" WHERE id=$id";
  $db->query($sql);
  $sql = "UPDATE sheet SET maxThickness=\"$max\" WHERE id=$id";
  $db->query($sql);

  /******************
  * RETURN
  ******************/
  $return = new stdClass;
  $return->x = $xTemp;
  $return->y = $yTemp;
  $return->z = $zTemp;
  $return->avg = $avg;
  $return->min = $min;
  $return->max = $max;
  $json = json_encode($return);
  echo $json;
?>
