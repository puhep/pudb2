<?php
require_once("database.php");
$db=new Database();
#print_r($_POST);
$test_id=$_POST['test_id'];
$thermal_id=$_POST['thermal_id'];
$xpos=$_POST['xpos'];
$ypos=$_POST['ypos'];
$channel=$_POST['channel'];

### link the test and sensor in the relational table
$sql="INSERT INTO sensor_test (test_id,thermal_id) VALUES ($test_id, $thermal_id)";
$db->query($sql);

# if the xpos is set, update the DB
if($xpos!=''){
    $sql="UPDATE sensor_test SET xpos=$xpos WHERE test_id=$test_id AND thermal_id=$thermal_id";
    $db->query($sql);
}

# if the ypos is set, update the DB
if($ypos!=''){
    $sql="UPDATE sensor_test SET ypos=$ypos WHERE test_id=$test_id AND thermal_id=$thermal_id";
    $db->query($sql);
}

# if the channel is set, update the DB
if($channel!=''){
    $sql="UPDATE sensor_test SET channel=$channel WHERE test_id=$test_id AND thermal_id=$thermal_id";
    $db->query($sql);
}
#echo "<br>";
#echo $sql;

### return to the add sensor page to expedite adding multiple objects at once
header("Location: test_edit.php?id=$test_id");

?>