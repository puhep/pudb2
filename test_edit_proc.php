<?php
require_once("database.php");
$db = new Database();

$test_id=$_POST['test_id'];
$backmessage = "Please press back and try again.<br>";

if($_POST['name'] != ""){
$sql="UPDATE test SET name = \"".$_POST['name']."\" WHERE id = ".$test_id;
$db->query($sql);
}

if($_POST['coolant_temp'] != ""){
$sql="UPDATE test SET coolant_temp = \"".$_POST['coolant_temp']."\" WHERE id = ".$test_id;
#echo $sql;
$db->query($sql);
}

if($_POST['remove_id'] != ""){
$sql="DELETE FROM sensor_test where test_id = ".$test_id." AND thermal_id = ".$_POST['remove_id'];
$db->query($sql);
}
### do a foreach loop on xpos and ypos
$i=0;
foreach($_POST['xpos'] as $xpos){
if($xpos != ""){
$sql="UPDATE sensor_test SET xpos = $xpos WHERE test_id = ".$test_id." AND thermal_id = ".$_POST['thermal_id'][$i];
#echo $sql."<br>";
$db->query($sql);
}
$i++;
}
$i=0;
foreach($_POST['ypos'] as $ypos){
if($ypos != ""){
$sql="UPDATE sensor_test SET ypos = $ypos WHERE test_id = ".$test_id." AND thermal_id = ".$_POST['thermal_id'][$i];
#echo $sql."<br>";
$db->query($sql);
}
$i++;
}
$i=0;
foreach($_POST['channel'] as $channel){
if($channel != ""){
$sql="UPDATE sensor_test SET channel = $channel WHERE test_id = ".$test_id." AND thermal_id = ".$_POST['thermal_id'][$i];
#echo $sql."<br>";
$db->query($sql);
}
$i++;
}

if($_POST['notes'] != ""){
  $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$test_id AND part_type=\"test\"";
  $db -> query($sql);
}

if($_FILES['pic']['name'] != ""){
$picupload=1;
#echo "pic detected<br>";
$targetdir = "./pics/test/$test_id/";
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

header("Location: test.php?id=$test_id");
?>