<html>

<?php
require_once("functions.php");
require_once("database.php");
$db = new Database();

$id=$_GET['id'];
   #$sql = "SELECT * FROM test WHERE id = ".$id;
   $sql="SELECT t.name as tname,t.id,s.*,ss.name as ss_name,st.xpos,st.ypos FROM test t JOIN sensor_test st ON st.test_id=t.id JOIN thermal_sensor s ON st.thermal_id=s.id JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=".$_GET['id'];
   $db->query($sql);
   $i=0;
while($db->nextRecord()){
$data[$i]=$db->Record;
$i++;
}
#$db->singleRecord();
#$data=$db->Record;
$name=$data[0]['tname'];
$ss_name=$data[0]['ss_name'];
?>

<title><?php echo $name ?> Summary</title>

<body>
<h1><?php echo $name; ?> Summary</h1>

<?php

echo "<p>Support Structure: ".$ss_name."</p>";

   show_sensors($data);

?>

<br><br>
<form method="get" action="test_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Edit Data">
</form>
<form method="get" action="add_sensor.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Add Sensor">
</form>
<br><br>
<input type=button onClick="location.href='test_list.php'" value='Test List'>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>

<!--
mysql> SELECT t.*,s.*,ss.name as ss_name FROM test t JOIN sensor_test st ON st.test_id=t.id JOIN thermal_sensor s ON st.thermal_id=s.id JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=1;
-->
