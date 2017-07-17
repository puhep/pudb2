<?php
  /******************
  * REQUIRE
  ******************/
  require_once("../database.php");
  $db = new Database();
  $sheets3 = $db->db_query("SELECT name, dateCut, mass_after FROM sheet WHERE ply=3");
  $sheets8 = $db->db_query("SELECT name, dateCut, mass_after FROM sheet WHERE ply=8");

  /******************
  * Graph Data
  ******************/
  $dataY3    = array();
  $dataX3    = array();
  $dataName3 = array();
  for ($i = 0; $i < sizeof($sheets3); $i++) {
    $dataY3[$i]    = $sheets3[$i]['mass_after'];
    $dataX3[$i]    = $sheets3[$i]['dateCut'];
    $dataName3[$i] = $sheets3[$i]['name'];
  }
  $dataY8    = array();
  $dataX8    = array();
  $dataName8 = array();
  for ($i = 0; $i < sizeof($sheets8); $i++) {
    $dataY8[$i]    = $sheets8[$i]['mass_after'];
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
