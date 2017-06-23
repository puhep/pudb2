<?php
#print_r($_POST);
require_once("database.php");
require_once("functions.php");
$db = new Database();
$ss       = $_POST['support_structure'];
$name     = $_POST['name'];
$testType = $_POST['testType'];
if ($ss != "none") {
  $sql="INSERT INTO test (name, assoc_ss, testType) VALUES (\"$name\", $ss, \"$testType\")";
} else if ($ss == "none") {
  $sql = "INSERT INTO test (name, testType) VALUES (\"$name\", \"$testType\")";
}
#echo $sql;
$db->query($sql);
$sql = "SELECT MAX(id) FROM test";
$db->query($sql);
$db->singleRecord();
$id= $db->Record['MAX(id)'];
$sql = "INSERT INTO notes (part_id,part_type) VALUES ($id,'test')";
$db->query($sql);
if($_POST['oldtest'] != "" && $_POST['old'] != "none"){
    $sql = "SELECT * FROM sensor_test WHERE test_id=".$_POST['oldtest'];
    $data=$db->db_query($sql);
    foreach($data as $line){
        #print_r($line);
        #echo "<br>";
        if($line['xpos']){ $xpos=$line['xpos']; }
        else{ $xpos="NULL"; }
        if($line['ypos']){ $ypos=$line['ypos']; }
        else{ $ypos="NULL"; }
        if($line['channel']){ $channel=$line['channel']; }
        else{ $channel="NULL"; }
        $sql = "INSERT INTO sensor_test (test_id,thermal_id,xpos,ypos,channel) VALUES ($id,".$line['thermal_id'].",".$xpos.",".$ypos.",".$channel.")";
        #echo $sql."<br>";
        $db->query($sql);
    }
}

if ($_FILES['tempVsTime']['name'] != "") {
  addTempVsTimeFile("test",$test_id,$_FILES['tempVsTime']);
}
    header("Location: test_edit.php?id=$id");


?>
