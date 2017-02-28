<?php
   require_once("database.php");
$db=new Database();
#print_r($_POST);
$test_id=$_POST['test_id'];
$thermal_id=$_POST['thermal_id'];
$test_name=$_POST[''];
$thermal_name=$_POST[''];
$xpos=$_POST['xpos'];
$ypos=$_POST['ypos'];
$channel=$_POST['channel'];
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
header("Location: add_sensor.php?id=$test_id");

?>