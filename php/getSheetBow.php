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
  $filePath = "../../phase_2/files/sheet/$id/BowContour.csv";
  $file = fopen($filePath, "r") or die("<h1>Something went wrong.</h1>");
  $x = array();
  $y = array();
  $z = array();
  $i = 0;
  while (!feof($file)) {
    $temp = fgetcsv($file);
    $x[$i] = (double) $temp[0];
    $y[$i] = (double) $temp[1];
    $z[$i++] = (double) $temp[2];
  }
  fclose($file); // save memory, close file
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
