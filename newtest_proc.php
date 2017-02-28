<?php
#print_r($_POST);
require_once("database.php");
$db = new Database();
$ss = $_POST['support_structure'];
$name = $_POST['name'];
$sql="INSERT INTO test (name, assoc_ss) VALUES (\"$name\", $ss)";
#echo $sql;
$db->query($sql);
$sql = "SELECT MAX(id) FROM test";
$db->query($sql);
$db->singleRecord();
$id= $db->Record['MAX(id)'];
$sql = "INSERT INTO notes (part_id,part_type) VALUES ($id,'test')";
$db->query($sql);
header("Location: add_sensor.php?id=$id");

?>