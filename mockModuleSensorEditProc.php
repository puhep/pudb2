<?php
  $backmessage="Please press back and try again.<br>";
  require_once("database.php");

  $id=$_POST['id'];
  $db=new Database();

  if ($_POST['curThickness'] != "") {
    $sql="update mock_module set si_thickness=".$_POST['curThickness']." where id=$id";
    $db -> query($sql);
  }
  if ($_POST['curAdhesive'] != "") {
    $sql="update mock_module set adhesive=\"".$_POST['curAdhesive']."\" where id=$id";
    $db -> query($sql);
  }
  if ($_POST['curGeometry'] != "") {
    $sql="update mock_module set geometry=\"".$_POST['curGeometry']."\" where id=$id";
    $db -> query($sql);
  }
  if ($_POST['notes'] != "") {
    $sql="update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(), '%m-%d-%y %T'), \" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"mock_module\"";
    $db -> query($sql);
  }


  ### redirect to the mock module summary page with the new information
  header("Location: module.php?id=$id");
?>
