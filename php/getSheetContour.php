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
  $x = array();
  $y = array();
  $z = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    if ((double)$temp[0] > 15 && (double)$temp[0] < 300 && (double)$temp[1] > 15 && (double)$temp[1] < 300) {
      $x[$i]   = (double) $temp[0];
      $y[$i]   = (double) $temp[1];
      $z[$i++] = (double) $temp[2];
    }
  }
  fclose($file); // save memory, close file

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
  if ($avgThick == "") {  // If thickness is not yet set
    $sql = "UPDATE sheet SET avgThickness=\"$avg\" WHERE id=$id";
    $db->query($sql);
    $sql = "UPDATE sheet SET minThickness=\"$min\" WHERE id=$id";
    $db->query($sql);
    $sql = "UPDATE sheet SET maxThickness=\"$max\" WHERE id=$id";
    $db->query($sql);
  }

  /******************
  * RETURN
  ******************/
  $return = new stdClass;
  $return->x = $x;
  $return->y = $y;
  $return->z = $z;
  $json = json_encode($return);
  echo $json;
?>
