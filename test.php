<html>

<?php
require_once("functions.php");
require_once("database.php");
$db = new Database();

$id=$_GET['id'];

$data=test_data($id,$db);

$name=$data[0]['tname'];
$ss_name=$data[0]['ss_name'];
$coolant_temp=$data[0]['coolant_temp'];


$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"test\"";
$db->query($sql);
$db->singleRecord();
$notes=$db->Record['notetext'];

?>

<title>Test <?php echo $name ?> Summary</title>

<body>
<h1>Test <?php echo $name; ?> Summary</h1>

<?php
echo "<p>Support Structure: <a href='ss_summary.php?id=".$data[0]['ssid']."'>$ss_name</a></p>";
echo "<p>Coolant Temperature: ".$data[0]['coolant_temp']."°C</p>";
echo "<h2>Sensor Data</h2>";
show_sensors($data);
echo "<br>";
echo "<a href=\"test_geometry.php?id=$id\" target=\"blank\"><img src=\"test_geometry.php?id=$id\" width=\"300\" height=\"300\" ></a>";

#show_geometry($data);
echo "<h2>Notes</h2>";
if($notes!=""){
    echo "<p>".nl2br($notes)."</p>";
}
else{
    echo "No notes found";
}
echo "<h2>Pictures</h2>";
show_pictures("test",$id);

echo "<h2>Misc Files</h2>";
show_files("test",$id);

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
