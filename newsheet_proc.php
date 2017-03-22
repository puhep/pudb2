<?php
require_once("database.php");
$db = new Database();
$sql = "INSERT INTO sheet (name) VALUES (\"".$_POST['name']."\")";
$db->query($sql);
$sql = "SELECT MAX(id) FROM sheet";
$db->query($sql);
$db->singleRecord();
$id= $db->Record['MAX(id)'];

header("Location: sheet_edit.php?id=$id")
?>