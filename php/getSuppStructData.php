<?php
  require_once("../database.php");
  $db = new Database();
  $id = $_GET['id'];

  $sql = "SELECT * FROM support_structure WHERE id=$id";
  $result = $db->db_query($sql);
  $result = $result[0];

  $return = new stdClass;
  $return->name                = $result['name'];
  $return->mass                = $result['mass'];
  $return->pipe_material       = $result['pipe_material'];
  $return->pipe_wall_thickness = $result['pipe_wall_thickness'];
  $return->foam_type           = $result['foam_type'];
  $return->wings_ply           = $result['wings_ply'];
  $return->airex_stack         = $result['airex_stack'];
  $return->lastEdit            = $result['lastEdit'];
  $json = json_encode($return);
  echo $json;
?>
