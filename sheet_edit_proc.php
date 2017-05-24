<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");
require_once("functions.php");

$id = $_POST['id'];
$db = new Database();

//print_r($_POST);
### update miscellaneous info if the fields have been filled
if($_POST['name'] != ""){
    $sql = "update sheet set name=\"".$_POST['name']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['location'] != ""){
    $sql = "update sheet set location = \"".$_POST['location']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['ply'] != ""){
    $sql = "update sheet set ply=".$_POST['ply']." where id=$id";
    $db -> query($sql);
}
if($_POST['mass_nb'] != ""){
    $sql = "update sheet set mass_nb=".$_POST['mass_nb']." where id=$id";
    $db -> query($sql);
}
if($_POST['mass_after'] != ""){
    $sql = "update sheet set mass_after=".$_POST['mass_after']." where id=$id";
    $db -> query($sql);
}
if($_POST['num_wax_coats'] != ""){
    $sql = "update sheet set num_wax_coats=".$_POST['num_wax_coats']." where id=$id";
    $db -> query($sql);
}
if($_POST['curing_stackup'] != ""){
    $sql = "update sheet set curing_stackup=\"".$_POST['curing_stackup']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_cut'] != ""){
    $sql = "update sheet set user_cut=\"".$_POST['user_cut']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_bagged'] != ""){
    $sql = "update sheet set user_bagged=\"".$_POST['user_bagged']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check1'] != ""){
    #echo "found";
    $sql = "update sheet set user_check1=\"".$_POST['user_check1']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check2'] != ""){
    $sql = "update sheet set user_check2=\"".$_POST['user_check2']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check3'] != ""){
    $sql = "update sheet set user_check3=\"".$_POST['user_check3']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_ramp'] != ""){
    $sql = "update sheet set user_ramp=\"".$_POST['user_ramp']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_measure'] != ""){
    $sql = "update sheet set user_measure=\"".$_POST['user_measure']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_remove'] != ""){
    $sql = "update sheet set user_remove=\"".$_POST['user_remove']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['thickness1'] != ""){
    $sql = "update sheet set thickness1=".$_POST['thickness1']." where id=$id";
    $db -> query($sql);
}
if($_POST['thickness2'] != ""){
    $sql = "update sheet set thickness2=".$_POST['thickness2']." where id=$id";
    $db -> query($sql);
}
if($_POST['thickness3'] != ""){
    $sql = "update sheet set thickness3=".$_POST['thickness3']." where id=$id";
    $db -> query($sql);
}
if($_POST['thickness4'] != ""){
    $sql = "update sheet set thickness4=".$_POST['thickness4']." where id=$id";
    $db -> query($sql);
}
### this concatenates existing notes, if any, with a new line including the date and the entered note text
if($_POST['notes'] != ""){
    $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"sheet\"";
    $db -> query($sql);
}

if ($_POST['lastEdit'] != "") {
  $sql = "UPDATE sheet SET lastEdit=\"".$_POST['lastEdit']."\" WHERE id=$id";
  $db->query($sql);
}

### if the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
if($_FILES['pic']['name'] != ""){
    add_pic("sheet",$id,$_FILES,$_POST['picnotes']);
}

### if the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
if(count($_FILES['files']['name'])){
    /*echo "file found?<br>";
    print_r($_FILES['files']);
    echo "<br><br>";
    echo count($_FILES['files']['name']);*/
    add_file("sheet",$id,$_FILES['files']);
}

### redirect to the summary page with the new information
header("Location: sheet.php?id=$id");
?>
