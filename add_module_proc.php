<?php
#print_r($_POST);
require_once("database.php");
$db=new Database();
#print_r($_POST);
$test_id=$_POST['test_id'];
$module_id=$_POST['module_id'];
$xpos=$_POST['xpos'];
$ypos=$_POST['ypos'];

if($module_id != "NULL"){
### link the test and sensor in the relational table
$sql="INSERT INTO module_test (test_id,module_id) VALUES ($test_id, $module_id)";
$db->query($sql);

# if the xpos is set, update the DB
if($xpos!=''){
    $sql="UPDATE module_test SET xpos=$xpos WHERE test_id=$test_id AND module_id=$module_id";
    $db->query($sql);
}

# if the ypos is set, update the DB
if($ypos!=''){
    $sql="UPDATE module_test SET ypos=$ypos WHERE test_id=$test_id AND module_id=$module_id";
    $db->query($sql);
}
#echo "<br>";
#echo $sql;

### return to the test editing page to expedite adding multiple objects at once
header("Location: test_edit.php?id=$test_id");
}
else{
    echo "Please select a module.";
        }
?>