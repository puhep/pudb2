<?php
  /******************
  *
  * This page checks to see what fields have been changed and then calls the database to update them.
  *
  * A faster way might be to add to a string and call then database once, instead of check, call, chech again...
  *
  ******************/
  $backmessage="Please press back and try again.<br>";
  require_once("database.php");
  require_once("functions.php");
  $id=$_POST['id'];
  $db=new Database();

  if ($_POST['curThickness'] != "") {
    $sql="UPDATE mock_module SET si_thickness=".$_POST['curThickness']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['curAdhesive'] != "") {
    $sql="UPDATE mock_module SET adhesive=\"".$_POST['curAdhesive']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['curGeometry'] != "") {
    $sql="UPDATE mock_module SET geometry=\"".$_POST['curGeometry']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['notes'] != "") {
    $sql="UPDATE notes SET notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(), '%m-%d-%y %T'), \" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"mock_module\"";
    $db -> query($sql);
  }

  if ($_POST['lastEdit'] != "") {
    $sql = "UPDATE mock_module SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
    $db->query($sql);
  }

  // If the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
  if ($_FILES['pic']['name'] != "") {
    add_pic("mock_module", $id, $_FILES, $_POST['picnotes']);
  }

  // If the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
  if ($_FILES['files']['name'][0] != "") {
    add_file("mock_module", $id, $_FILES['files']);
  }

  // Redirect to the summary page with the new information
  header("Location: module.php?id=$id");
?>
