<html>
<?php
require_once("database.php");
require_once("functions.php");
$db = new Database();
$sql="SELECT t.name as tname,t.id,s.*,s.id as sid,ss.id as ssid,ss.name as ss_name,st.xpos,st.ypos,st.channel FROM test t LEFT JOIN sensor_test st ON st.test_id=t.id LEFT JOIN thermal_sensor s ON st.thermal_id=s.id LEFT JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=".$_GET['id'];
$db->query($sql);
$i=0;
while($db->nextRecord()){
    $data[$i]=$db->Record;
    $i++;
}
#print_r($data);
$notstr="";
if($i>=1){
    $notstr=" WHERE id != 0";
    foreach($data as $ids){
        if($ids['sid']){ $notstr.=" AND id != ".$ids['sid']; }
    }
}
#echo $notstr;

   ?>

  <head>
    <title>Add Sensor to <?php echo $data[0]['tname']; ?></title>
    <body>
      <h1>Add Sensor to <?php echo $data[0]['tname']; ?></h1>
      <?php show_sensors($data); ?>
      <br>
      <form action="add_sensor_proc.php" method="post" enctype="multipart/from-data">
	<div style="width:280px;">
	Sensor: <select name="thermal_id">  
<?php
    
    echo "<option value=\"NULL\">Select a Sensor</option>\n";

$sql="SELECT name,id FROM thermal_sensor".$notstr;
$sensor_data=db_query($sql,$db);
foreach($sensor_data as $row){
    $id=$row['id'];
    $name=$row['name'];
    echo "<option value=\"$id\">".$name."</option>\n";
}
echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
?>
	</select>
	<br><br>
	X Position (cm): <input type="text" name="xpos" style="float:right">
	<br><br>
	Y Position (cm): <input type="text" name="ypos" style="float:right">
	<br><br>
	Channel: <input type="text" name="channel" style="float:right">
	<br><br>
	</div>
	<input type="submit" name="submit" value="Submit">
      </form>
      <form method="get" action="test_edit.php">
	<?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
	<input type="submit" value="Edit Data">
      </form>
      <br>
      <form method="get" action="test.php">
	<?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	      ?>
	<input type="submit" value="Test Summary">
	</form>

      <input type=button onClick="location.href='index.php'" value='Index'>

      </body>
      
</html>
