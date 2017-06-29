<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");
require_once("functions.php");

$id = $_POST['id'];
$db = new Database();

if($_POST['cur_channel'] != ""){
    $sql = "update thermal_sensor set cur_channel=".$_POST['cur_channel']." where id=$id";
    $db -> query($sql);
}
if ($_POST['notes'] != "") {
  $sql="update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),
  '%m-%d-%y %T'), \" ".$_POST['notes']."\",'\n') where part_id=$id AND
  part_type=\"thermal_sensor\"";
$db -> query($sql);
}

  if ($_POST['color'] != "") {
    $sql = "UPDATE thermal_sensor SET color=\"".$_POST['color']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['status'] != "") {
    $sql ="UPDATE thermal_sensor SET status=\"".$_POST['status']."\" WHERE id=$id";
    $db->query($sql);
  }

if ($_POST['lastEdit'] != "") {
  $sql = "UPDATE thermal_sensor SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
  $db->query($sql);
}
if ($_FILES['pic']['name'] != "") {
  add_pic("thermal_sensor",$id,$_FILES,$_POST['picnotes']);
}

if ($_FILES['files']['name'][0] != "") {
  // print_r($_FILES);
  add_file("thermal_sensor", $id, $_FILES['files']);
}

### redirect to the structure summary page with the new information
header("Location: thermal_sensor.php?id=$id");


?>
