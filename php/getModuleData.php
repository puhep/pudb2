<?php
  require_once("../database.php");
  $db = new Database();
  $id = $_GET['id'];

  $sql = "SELECT * FROM mock_module WHERE id=$id";
  $result = $db->db_query($sql);
  $result = $result[0];

  $return = new stdClass;
  $return->name         = $result['name'];
  $return->si_thickness = $result['si_thickness'];
  $return->adhesive     = $result['adhesive'];
  $return->geometry     = $result['geometry'];
  $return->lastEdit     = $result['lastEdit'];
  $json = json_encode($return);
  echo $json;
?>
