<?php
require_once("database.php");
$db = new Database();

$test_id=$_POST['test_id'];

### a message used in all of my rudimentary error messages
$backmessage = "Please press back and try again.<br>";

### change the name of the test
if($_POST['name'] != ""){
    $sql="UPDATE test SET name = \"".$_POST['name']."\" WHERE id = ".$test_id;
    $db->query($sql);
}

### edit the coolant temperature used in the test
if($_POST['coolant_temp'] != ""){
    $sql="UPDATE test SET coolant_temp = \"".$_POST['coolant_temp']."\" WHERE id = ".$test_id;
    #echo $sql;
    $db->query($sql);
}

### if the user specified a module to remove, delete from the relational sensor_test table to break the association between sensor and test
if($_POST['remove_id'] != ""){
    $sql="DELETE FROM sensor_test where test_id = ".$test_id." AND thermal_id = ".$_POST['remove_id'];
    $db->query($sql);
}

### do a foreach loop on xpos and ypos, arrays filled by the user. If they are filled, enter the data for each one.
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

### this concatenates existing notes, if any, with a new line including the date and the entered note text
if($_POST['notes'] != ""){
    $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$test_id AND part_type=\"test\"";
    $db -> query($sql);
}

### if the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
if($_FILES['pic']['name'] != ""){
    $picupload=1;
    #echo "pic detected<br>";
    $targetdir = "../phase_2/pics/test/$test_id/";
    $targetfile = $targetdir.$_FILES['pic']['name'];
    $imageFileType = pathinfo($targetfile,PATHINFO_EXTENSION);
    ### if the directory for the test does not exist, create it and make it editable
    if(!file_exists($targetdir)){
        mkdir($targetdir);
        chmod($targetdir,0777);
	}
    ### don't allow duplicate uploads
    if(file_exists($targetfile)){
    echo "Sorry, file already exists.<br>".$backmessage;
    $picupload = 0;
}
    ### only picture type files are allowed
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>".$backmessage;
    $picupload = 0;
}
    ### if none of the errors have been detected, proceed with the upload
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

    ### if the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
    if($_FILES['file']['name'] != ""){
    #echo "file detected<br>";
    $targetdir = "../phase_2/files/test/$test_id/";
    $targetfile = $targetdir.$_FILES['file']['name'];
    ### if the directory for the structure does not exist, create it and make it editable
    if(!file_exists($targetdir)){
    mkdir($targetdir);
    chmod($targetdir,0777);
}
    if(!move_uploaded_file($_FILES['file']['tmp_name'], $targetfile)){
    echo "Sorry, an error has occurred. Try again or bother Greg until he helps";
}
}
    ### redirect to the test summary page with the new information
    header("Location: test.php?id=$test_id");
?>