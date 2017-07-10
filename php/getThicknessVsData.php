<?php
  /******************
  * REQUIRE
  ******************/
  require_once("../database.php");
  $db = new Database();
  $sheets3 = $db->db_query("SELECT avgThickness, name, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=3");
  $sheets8 = $db->db_query("SELECT avgThickness, name, thickness1, thickness2, thickness3, thickness4, dateCut FROM sheet WHERE ply=8");

    /******************
    * Graph Data
    ******************/
  $dataY3    = array();
  $dataX3    = array();
  $dataName3 = array();
  for ($i = 0; $i < sizeof($sheets3); $i++) {
    if ($sheets3[$i]['avgThickness'] == "") {
      $dataY3[$i] = (($sheets3[$i]['thickness1'] + $sheets3[$i]['thickness2'] + $sheets3[$i]['thickness3'] + $sheets3[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY3[$i] = $sheets3[$i]['avgThickness'] * 1000;
    }
    $dataX3[$i]    = $sheets3[$i]['dateCut'];
    $dataName3[$i] = $sheets3[$i]['name'];
  }
  $dataY8    = array();
  $dataX8    = array();
  $dataName8 = array();
  for ($i = 0; $i < sizeof($sheets8); $i++){
    if ($sheets8[$i]['avgThickness'] == null) {
      $dataY8[$i] = (($sheets8[$i]['thickness1'] + $sheets8[$i]['thickness2'] + $sheets8[$i]['thickness3'] + $sheets8[$i]['thickness4']) / 4) * 1000; // Avevrage Thickness times 100 to put it in microns
    } else {
      $dataY8[$i] = $sheets8[$i]['avgThickness'] * 1000;
    }
    $dataX8[$i]    = $sheets8[$i]['dateCut'];
    $dataName8[$i] = $sheets8[$i]['name'];
  }

  /******************
  * RETURN
  ******************/
  $return = new stdClass;
  $return->x3    = $dataX3;
  $return->y3    = $dataY3;
  $return->name3 = $dataName3;
  $return->x8    = $dataX8;
  $return->y8    = $dataY8;
  $return->name8 = $dataName8;
  $json = json_encode($return);
  echo $json;

?>
