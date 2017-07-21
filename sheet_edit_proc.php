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
    $sql = "UPDATE sheet SET name=\"".$_POST['name']."\" WHERE id=$id";
    $db -> query($sql);
  }
  if ($_POST['location'] != "") {
    $sql = "UPDATE sheet SET location = \"".$_POST['location']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['dateCut'] != "") {
    $sql = "UPDATE sheet SET dateCut=\"".$_POST['dateCut']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['dateOven'] != "") {
    $sql = "UPDATE sheet SET dateOven=\"".$_POST['dateOven']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['bagUseTimes'] != "") {
    $sql = "UPDATE sheet SET bagUseTimes=".$_POST['bagUseTimes']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['ovenStart'] != "") {
    $sql = "UPDATE sheet SET ovenStart=\"".$_POST['ovenStart']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['ovenReach177'] != "") {
    $sql = "UPDATE sheet SET ovenReach177=\"".$_POST['ovenReach177']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['ovenReach107'] != "") {
    $sql = "UPDATE sheet SET ovenReach107=\"".$_POST['ovenReach107']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['timeRamp'] != "") {
    $sql = "UPDATE sheet SET timeRamp=\"".$_POST['timeRamp']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['timeOvenOff'] != "") {
    $sql = "UPDATE sheet SET timeOvenOff=\"".$_POST['timeOvenOff']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['timeRemoved'] != "") {
    $sql = "UPDATE sheet SET timeRemoved=\"".$_POST['timeRemoved']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['lengthOutside'] != "") {
    $sql = "UPDATE sheet SET lengthOutside=".$_POST['lengthOutside']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['lengthInside'] != "") {
    $sql = "UPDATE sheet SET lengthInside=".$_POST['lengthInside']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['heightOutside'] != "") {
    $sql = "UPDATE sheet SET heightOutside=".$_POST['heightOutside']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['heightInside'] != "") {
    $sql = "UPDATE sheet SET heightInside=".$_POST['heightInside']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['bow'] != "") {
    $sql = "UPDATE sheet SET bow=".$_POST['bow']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['checkedLeaks'] != "N/A") {
    $sql = "UPDATE sheet SET checkedLeaks=\"".$_POST['checkedLeaks']."\" WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['avgThickness'] != "") {
    $sql ="UPDATE sheet SET avgThickness=".$_POST['avgThickness']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['minThickness'] != "") {
    $sql ="UPDATE sheet SET minThickness=".$_POST['minThickness']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['maxThickness'] != "") {
    $sql = "UPDATE sheet SET maxThickness=".$_POST['maxThickness']." WHERE id=$id";
    $db->query($sql);
  }

  if ($_POST['ply'] != "") {
    $sql = "UPDATE sheet SET ply=".$_POST['ply']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['mass_nb'] != "") {
    $sql = "UPDATE sheet SET mass_nb=".$_POST['mass_nb']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['mass_after'] != "") {
    $sql = "UPDATE sheet SET mass_after=".$_POST['mass_after']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['num_wax_coats'] != "") {
    $sql = "UPDATE sheet SET num_wax_coats=".$_POST['num_wax_coats']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['curing_stackup'] != "") {
    $sql = "UPDATE sheet SET curing_stackup=\"".$_POST['curing_stackup']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_cut'] != "") {
    $sql = "UPDATE sheet SET user_cut=\"".$_POST['user_cut']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_bagged'] != "") {
    $sql = "UPDATE sheet SET user_bagged=\"".$_POST['user_bagged']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_check1'] != "") {
    $sql = "UPDATE sheet SET user_check1=\"".$_POST['user_check1']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_check2'] != "") {
    $sql = "UPDATE sheet SET user_check2=\"".$_POST['user_check2']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_check3'] != "") {
    $sql = "UPDATE sheet SET user_check3=\"".$_POST['user_check3']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_ramp'] != "") {
    $sql = "UPDATE sheet SET user_ramp=\"".$_POST['user_ramp']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_measure'] != "") {
    $sql = "UPDATE sheet SET user_measure=\"".$_POST['user_measure']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['user_remove'] != "") {
    $sql = "UPDATE sheet SET user_remove=\"".$_POST['user_remove']."\" WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['thickness1'] != "") {
    $sql = "UPDATE sheet SET thickness1=".$_POST['thickness1']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['thickness2'] != "") {
    $sql = "UPDATE sheet SET thickness2=".$_POST['thickness2']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['thickness3'] != "") {
    $sql = "UPDATE sheet SET thickness3=".$_POST['thickness3']." WHERE id=$id";
    $db -> query($sql);
  }

  if ($_POST['thickness4'] != "") {
    $sql = "UPDATE sheet SET thickness4=".$_POST['thickness4']." WHERE id=$id";
    $db -> query($sql);
  }

  // This concatenates existing notes, if any, with a new line including the date and the entered note text
  if ($_POST['notes'] != "") {
    $sql = "UPDATE notes SET notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') WHERE part_id=$id AND part_type=\"sheet\"";
    $db -> query($sql);
  }

  if ($_POST['lastEdit'] != "") {
    $sql = "UPDATE sheet SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
    $db->query($sql);
  }

  // If the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
  if ($_FILES['pic']['name'] != "") {
    add_pic("sheet",$id,$_FILES,$_POST['picnotes']);
  }

  // If the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
  if ($_FILES['files']['name'][0] != "") {
    add_file("sheet",$id,$_FILES['files']);
  }

  // If the thicknessContour file has been select, then attempt to upload it
  if ($_FILES['thicknessContour']['name'] != "") {
    addSheetThicknessContour($id, $_FILES['thicknessContour']);
  }

  // Redirect to the summary page with the new information
  header("Location: sheet.php?id=$id");
?>
