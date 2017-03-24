<?php
require_once("database.php");
$db = new Database();
$sql = "INSERT INTO sheet (name) VALUES (\"".$_POST['name']."\")";
$db->query($sql);
$sql = "SELECT MAX(id) FROM sheet";
$db->query($sql);
$db->singleRecord();
$id= $db->Record['MAX(id)'];
$sql = "INSERT INTO notes (part_type,part_id) VALUES (\"sheet\",$id)";
$db->query($sql);
header("Location: sheet_edit.php?id=$id")
?>