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

  /*****************************
   * Delete file from server
   ****************************/
  $fileLoc = "../../phase_2/pics/$partType/$partID/$fileName";
  $fileLoc = str_replace("\"", "", $fileLoc);
  $del = unlink($fileLoc);
?>
