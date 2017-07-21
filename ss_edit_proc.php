<?php
  /******************
  *
  * This page checks to see what fields have been changed and then calls the database to update them.
  *
  * A faster way might be to add to a string and call then database once, instead of check, call, chech again...
  *
  ******************/
  $backmessage = "Please press back and try again.<br>";
  require_once("database.php");
  require_once("functions.php");

  $id = $_POST['id'];
  $db = new Database();

  // UPDATE miscellaneous info if the fields have been filled
  if ($_POST['name'] != "") {
    $sql = "update support_structure set name=\"".$_POST['name']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['mass'] != "") {
    $sql = "update support_structure set mass=\"".$_POST['mass']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['pipe_material'] != "") {
    $sql = "update support_structure set pipe_material=\"".$_POST['pipe_material']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['pipe_wall_thickness'] != "") {
    $sql = "update support_structure set pipe_wall_thickness=\"".$_POST['pipe_wall_thickness']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['foam_type'] != "") {
    $sql = "update support_structure set foam_type=\"".$_POST['foam_type']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['wings_ply'] != "") {
    $sql = "update support_structure set wings_ply=\"".$_POST['wings_ply']."\" where id=$id";
    $db -> query($sql);
  }

  if ($_POST['airex_stack'] != "") {
    $sql = "update support_structure set airex_stack=\"".$_POST['airex_stack']."\" where id=$id";
    $db -> query($sql);
  }

  // This concatenates existing notes, if any, with a new line including the date and the entered note text
  if ($_POST['notes'] != "") {
    $sql = "UPDATE notes SET notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') WHERE part_id=$id AND part_type=\"support_structure\"";
    $db -> query($sql);
  }

  // If the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
  if ($_FILES['pic']['name'] != "") {
    add_pic("support_structure",$id,$_FILES,$_POST['picnotes']);
  }

  if ($_POST['lastEdit'] != "") {
    $sql = "UPDATE support_structure SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
    $db->query($sql);
  }

  // If the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
  if ($_FILES['files']['name'][0] != "") {
    add_file("support_structure", $id, $_FILES['files']);
  }

  // Redirect to the summary page with the new information
  header("Location: ss_summary.php?id=$id");
?>
