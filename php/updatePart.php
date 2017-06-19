<?php
  // Requires
  require_once("../database.php");
  $db = new Database();

  // Get variables
  $id       = $_GET['id'];
  $partType = $_GET['partType'];
  $field    = $_GET['field'];
  $value    = $_GET['value'];

  // SQL Statement to update
  $sql = "UPDATE $partType SET $field=\"$value\" WHERE id=$id";
  // echo $sql;
  $db->query($sql); // Execute the SQL statement
?>
