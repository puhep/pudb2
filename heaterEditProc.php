<?php
  $backmessage="Please press back and try again.<br>";
  require_once("database.php");
  require_once("functions.php");

  $id=$_POST['id'];
  $db=new Database();

  if ($_POST['notes'] != "") {
    $sql="update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(), '%m-%d-%y %T'), \" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"heater\"";
    $db -> query($sql);
  }

  if ($_POST['lastEdit'] != "") {
    $sql = "UPDATE heater SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
    $db->query($sql);
  }

  //  If a pic file has been uploaded then add the picture and notes
  if ($_FILES['pic']['name'] != "") {
    add_pic("heater", $id, $_FILES, $_POST['picnotes']);
  }

  //  If 1 or more files have been uploaded then save them
  if ($_FILES['files']['name'][0] != "") {
    add_file("heater", $id, $_FILES['files']);
  }

  ### Redirect to the mock module summary page with the new information
  header("Location: heater.php?id=$id");
?>
