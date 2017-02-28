<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");

$id = $_POST['id'];
$db = new Database();

if($_POST['name'] != ""){
  $sql = "update support_structure set name=\"".$_POST['name']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['mass'] != ""){
  $sql = "update support_structure set mass=\"".$_POST['mass']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['pipe_material'] != ""){
  $sql = "update support_structure set pipe_material=\"".$_POST['pipe_material']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['pipe_wall_thickness'] != ""){
  $sql = "update support_structure set pipe_wall_thickness=\"".$_POST['pipe_wall_thickness']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['foam_type'] != ""){
  $sql = "update support_structure set foam_type=\"".$_POST['foam_type']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['wings_ply'] != ""){
  $sql = "update support_structure set wings_ply=\"".$_POST['wings_ply']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['airex_stack'] != ""){
  $sql = "update support_structure set airex_stack=\"".$_POST['airex_stack']."\" where id=$id";
  $db -> query($sql);
}
if($_POST['notes'] != ""){
  $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"support_structure\"";
  $db -> query($sql);
}


if($_FILES['pic']['name'] != ""){
$picupload=1;
#echo "pic detected<br>";
$targetdir = "./pics/support_structure/$id/";
$targetfile = $targetdir.$_FILES['pic']['name'];
$imageFileType = pathinfo($targetfile,PATHINFO_EXTENSION);
if(!file_exists($targetdir)){
	mkdir($targetdir);
	chmod($targetdir,0777);
	}
if (file_exists($targetfile)) {
    echo "Sorry, file already exists.<br>".$backmessage;
    $picupload = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>".$backmessage;
    $picupload = 0;
}
if($picupload==1){
#echo "ok to upload";
move_uploaded_file($_FILES['pic']['tmp_name'], $targetfile);
$fp = fopen(substr($targetfile,0,-3)."txt","w");
$date = date("m-d-y H:i:s");
#echo $date;
fwrite($fp,$date." ".$_POST['picnotes']."\n");
fclose($fp);
}
}

if($_FILES['file']['name'] != ""){
echo "file detected<br>";
$targetdir = "./files/support_structure/$id/";
$targetfile = $targetdir.$_FILES['file']['name'];
if(!file_exists($targetdir)){
	mkdir($targetdir);
	chmod($targetdir,0777);
	}
move_uploaded_file($_FILES['file']['tmp_name'], $targetfile);
}

header("Location: ss_summary.php?id=$id");


?>
