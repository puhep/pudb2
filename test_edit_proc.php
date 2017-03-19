<?php
require_once("database.php");
require_once("functions.php");
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
    add_pic("test",$id,$_FILES,$_POST['picnotes']);
}

### if the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
if(count($_FILES['files']['name'])){
    add_file("test",$id,$_FILES['files']);
}

### redirect to the test summary page with the new information
header("Location: test.php?id=$test_id");
?>