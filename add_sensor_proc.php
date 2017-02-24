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
$sql="INSERT INTO sensor_test (test_id,thermal_id,xpos,ypos) VALUES ($test_id, $thermal_id,$xpos,$ypos)";
#echo "<br>";
#echo $sql;
$db->query($sql);
header("Location: add_sensor.php?id=$test_id");

?>