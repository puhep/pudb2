<html>

<?php

require_once("database.php");
require_once("functions.php");
$db = new Database();

$id=$_GET['id'];
$sql="SELECT t.name as tname,t.id,t.coolant_temp,s.*,s.id as sid,ss.id as ssid,ss.name as ss_name,st.xpos,st.ypos,st.channel FROM test t LEFT JOIN sensor_test st ON st.test_id=t.id LEFT JOIN thermal_sensor s ON st.thermal_id=s.id LEFT JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=".$_GET['id'];
   $db->query($sql);
   $i=0;
while($db->nextRecord()){
$data[$i]=$db->Record;
$i++;
}
$name=$data[0]['tname'];
$ss_name=$data[0]['ss_name'];
$coolant_temp=$data[0]['coolant_temp'];
?>

<title>Edit Test <?php echo $name ?></title>

<body>
<h1>Edit Test <?php echo $name; ?></h1>

<h2>Sensor Data</h2>
<form action="test_edit_proc.php" method="post" enctype="multipart/form-data">
   <div style="width:275px;">
     Name: <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
     Coolant <br>Temp (°C): <input placeholder= "<?php echo $coolant_temp; ?>" name="coolant_temp" type="text" style="float:right"><br><br>     
</div>

   
   Remove Sensor: <select name="remove_id">  
    <?php
   echo "<option value=\"NULL\">Select a Sensor</option>\n";
   foreach($data as $row){
   $id=$row['id'];
   $name=$row['name'];
   echo "<option value=\"$id\">".$name."</option>\n";
   }
   ?>
</select>
   <br><br>

   <?php show_sensors($data,$edit=1); ?>

   <h2>Notes</h2>
   <?php echo nl2br($notes); ?>
   <br>
   <div style="width:225px;">
  Notes: <input name="notes" type="text" style="float:right"><br><br>
   </div>
   
<h2>Pictures</h2>
   <div style="width:340px;">
Picture File: <input name="pic" type="file" style="float:right"><br><br>
</div>
   <div style="width:275px;">
  Picture Notes: <input name="picnotes" type="text" style="float:right"><br><br>
</div>

<?php echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>"; ?>

<br><br>
   <input type="submit" name="submit" value="Submit">  
</form>

<form method="get" action="add_sensor.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Add Sensor">
</form>
<br><br>
<form method="get" action="test.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Test Summary">
</form>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
