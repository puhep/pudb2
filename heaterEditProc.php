<?php
  $backmessage="Please press back and try again.<br>";
  require_once("database.php");

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


  ### Redirect to the mock module summary page with the new information
  header("Location: heater.php?id=$id");
?>
