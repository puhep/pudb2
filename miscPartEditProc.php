<?php
  require_once("database.php");
  require_once("functions.php");
  $id = $_POST['id'];
  $db = new Database();

  if ($_POST['name'] != "") {
    $sql = "UPDATE miscPart SET name=\"".$_POST['name']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['currentLocation'] != "") {
    $sql = "UPDATE miscPart SET currentLocation=\"".$_POST['currentLocation']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['prodLocation'] != "") {
    $sql = "UPDATE miscPart SET prodLocation=\"".$_POST['prodLocation']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['notes'] != "") {
    $sql="UPDATE notes SET notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(), '%m-%d-%y %T'), \" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"miscPart\"";
    $db -> query($sql);
  }

  if ($_POST['lastEdit'] != "") {
    $sql = "UPDATE miscPart SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
    $db->query($sql);
  }

  // If the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
  if ($_FILES['pic']['name'] != "") {
    add_pic("miscPart", $id, $_FILES, $_POST['picnotes']);
  }

  // If the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
  if ($_FILES['files']['name'][0] != "") {
    add_file("miscPart", $id, $_FILES['files']);
  }

  // Redirect to the summary page with the new information
  header("Location: miscPart.php?id=$id");
?>
