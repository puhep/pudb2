<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");

$id = $_POST['id'];
$db = new Database();

if($_POST['cur_channel'] != ""){
    $sql = "update thermal_sensor set cur_channel=".$_POST['cur_channel']." where id=$id";
    $db -> query($sql);
}

### redirect to the structure summary page with the new information
header("Location: thermal_sensor.php?id=$id");


?>