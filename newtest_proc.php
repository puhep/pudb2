<?php
#print_r($_POST);
require_once("database.php");
require_once("functions.php");
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
if($_POST['oldtest'] != ""){
    $sql = "SELECT * FROM sensor_test where test_id=".$_POST['oldtest'];
    $data=db_query($sql,$db);
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
    header("Location: test_edit.php?id=$id");


?>