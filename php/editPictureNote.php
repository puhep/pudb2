<?php
  /***************
   * REQUIRE
   **************/
  require_once("../database.php");
  $db = new Database();

  /********************
   * GET variables
   *******************/
  $id = $_GET['id'];
  $partType = $_GET['partType'];
  $noteText = $_GET['noteText'];

  /*******************
   * SQL statement
   ******************/
  $sql = "UPDATE picture_note SET noteText=\"$noteText\" WHERE id=\"$id\";";

  /************************
   * Post to Database
   ***********************/
  $db->query($sql);

?>
