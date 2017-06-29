<?php
  require_once("../database.php");
  $db = new Database();
  $id = $_GET['id'];

  $sql = "SELECT * FROM thermal_sensor WHERE id=$id";
  $result = $db->db_query($sql);
  $result = $result[0];

  $return = new stdClass;
  $return->name        = $result['name'];
  $return->sensor_type = $result['sensor_type'];
  $return->color       = $result['color'];
  $return->cur_channel = $result['cur_channel'];
  $return->status      = $result['status'];
  $return->lastEdit    = $result['lastEdit'];
  $json = json_encode($return);
  echo $json;
?>
