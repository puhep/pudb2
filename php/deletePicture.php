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
  $partID = $_GET['partID'];
  $fileName = $_GET['fileName'];

  /*******************
   * SQL statement
   ******************/
  $sql = "DELETE FROM picture_note WHERE id=\"$id\";";

  /************************
   * Post to Database
   ***********************/
  $db->query($sql);

?>
