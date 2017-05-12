<html>

<?php
require_once("functions.php");
require_once("database.php");
$db = new Database();

$id=$_GET['id'];

$miscData=testData2($id,$db);
$sensorData = sensorTestData($id,$db);
$heaterData = heaterTestData($id,$db);
$moduleData = moduleTestData($id,$db);

$name=$miscData['testName'];
$ssName=$miscData['ssName'];
$ssID=$miscData['ssID'];
$coolantTemp=$miscData['coolantTemp'];

$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"test\"";
$db->query($sql);
$db->singleRecord();
$notes=$db->Record['notetext'];

?>

<title>Test <?php echo $name ?> Summary</title>

<body>
<h1>Test <?php echo $name; ?> Summary</h1>

<form method="get" action="test_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Edit Test">
</form>

<?php

echo "<p>Support Structure: <a href='ss_summary.php?id=".$ssID."'>$ssName</a></p>";
echo "<p>Coolant Temperature: ".$coolantTemp."&deg;C</p>";
echo "<h2>Object Data</h2>";
show_sensors($sensorData);
echo "<br>";
show_sensors($heaterData,0,"heater");
echo "<br>";
show_sensors($moduleData,0,"module");
echo "<br>";
echo "<a href=\"test_geometry.php?id=$id\" target=\"blank\"><img src=\"test_geometry.php?id=$id\" width=\"300\" height=\"300\" ></a>";

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


<input type=button onClick="location.href='test_list.php'" value='Test List'>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
