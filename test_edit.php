<?php
require_once("database.php");
require_once("functions.php");
$db = new Database();

$id=$_GET['id'];

$sensorData = sensorTestData($id,$db);
$heaterData = heaterTestData($id,$db);
$moduleData = moduleTestData($id,$db);

$data = testData2($id,$db);
$name=$data['testName'];
$ss_name=$data['ssName'];
$coolantTemp=$data['coolantTemp'];

?>

<html>

<title>Edit Test <?php echo $name ?></title>

<body>
<h1>Edit Test <?php echo $name; ?></h1>

    <form method="get" action="test.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	    ?>
      <input type="submit" value="Test Summary">
    </form>
    
<!-- Add Object - select object type and display fields accordingly -->
    
    Add Object: <select name="object_type" onchange="show_fields(this);">
    <option value ="NULL">Select Object Type</option>
    <option value ="thermal">Thermal Sensor</option>
    <option value ="heater">Heater</option>
    <option value ="module">Mock Module</option>
    </select>
    <br><br>
    <div id="thermal" style="display:none; width:290px;">
    <form action="add_sensor_proc.php" method="post" enctype="multipart/from-data">
	Add Sensor: <select name="thermal_id" id="sensor" onchange="selectChannel(this);">
<?php
    $notstr="";
if(count($sensorData)){
    $notstr=" WHERE id != 0";
    foreach($sensorData as $ids){
        if($ids['sensorID']){ $notstr.=" AND id != ".$ids['sensorID']; }
    }
}
echo "<option value=\"NULL\">Select a Sensor</option>\n";

$sql="SELECT name,id,cur_channel FROM thermal_sensor".$notstr;
$curChannels = array();
$sensor_data=db_query($sql,$db);
foreach($sensor_data as $row){
    $id=$row['id'];
    $tsname=$row['name'];
    $curChannel=$row['cur_channel'];
    $curChannels[$id] = $curChannel;
    echo "<option value=\"$id\">".$tsname."</option>\n";
}
$curChannels = json_encode($curChannels);
echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
?>
	</select>
	<br><br>
	X Position (cm): <input type="text" name="xpos" style="float:right">
	<br><br>
        Y Position (cm): <input type="text" name="ypos" style="float:right">
        <br><br>
Channel: <input type="number" name="channel" id="channel" style="float:right">
	<br><br>
	Note: If the channel is blank, the default channel will be used.
	<br><br>
	<input type="submit" name="submit" value="Add Thermal Sensor">
    </form>
    </div>
    <div id="heater" style="display:none; width:290px;">
      <form action="add_heater_proc.php" method="post" enctype="multipart/from-data">
	Add Heater: <select name="heater_id" id="heater">
	  <?php
	     $notstr="";
	     if(count($heaterData)){
	     $notstr=" WHERE id != 0";
	     foreach($heaterData as $ids){
             if($ids['heaterID']){ $notstr.=" AND id != ".$ids['heaterID']; }
	     }
	     }
	     echo "<option value=\"NULL\">Select a Heater</option>\n";
	     
	     $sql="SELECT name,id FROM heater".$notstr;
	     $heater_data=db_query($sql,$db);
	     foreach($heater_data as $row){
	     $hid=$row['id'];
	     $heater_name=$row['name'];
	     echo "<option value=\"$hid\">".$heater_name."</option>\n";
	     }
	     echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
	     ?>
	</select>
	<br><br>
	X Position (cm): <input type="text" name="xpos" style="float:right">
	<br><br>
	Y Position (cm): <input type="text" name="ypos" style="float:right">
	<br><br>
	<input type="submit" name="submit" value="Add Heater">
      </form>
    </div>
    <div id="module" style="display:none; width:290px;">
       <form action="add_module_proc.php" method="post" enctype="multipart/from-data">
	Add Module: <select name="module_id" id="module">
	  <?php
	     $notstr="";
	     if(count($moduleData)){
	     $notstr=" WHERE id != 0";
	     foreach($moduleData as $ids){
             if($ids['moduleID']){ $notstr.=" AND id != ".$ids['moduleID']; }
	     }
	     }
	     echo "<option value=\"NULL\">Select a Module</option>\n";
	     
	     $sql="SELECT name,id FROM mock_module".$notstr;
	     $heater_data=db_query($sql,$db);
	     foreach($heater_data as $row){
	     $id=$row['id'];
	     $module_name=$row['name'];
	     echo "<option value=\"$id\">".$module_name."</option>\n";
	     }
	     echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
	     ?>
	</select>
	<br><br>
	X Position (cm): <input type="text" name="xpos" style="float:right">
	<br><br>
	Y Position (cm): <input type="text" name="ypos" style="float:right">
	<br><br>
	<input type="submit" name="submit" value="Add Module">
      </form>
    </div>
    
    </div>
    <form action="test_edit_proc.php" method="post" enctype="multipart/form-data">
      <div style="width:275px;">
	<h2>Misc Data</h2>
	Name: <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
             Coolant <br>Temp (&deg;C): <input placeholder= "<?php echo $coolantTemp; ?>" name="coolant_temp" type="text" style="float:right"><br><br>     
      </div>
      
      <h2>Object Data</h2>
      Remove Sensor: <select name="removeSensorID">  
	<?php
	   echo "<option value=\"NULL\">Select a Sensor</option>\n";
foreach($sensorData as $row){
	   $id=$row['sensorID'];
	   $name=$row['sensorName'];
	   echo "<option value=\"$id\">".$name."</option>\n";
	   }
	   ?>
      </select>
      <br><br>
      Remove Heater: <select name="removeHeaterID">  
	<?php
	   echo "<option value=\"NULL\">Select a Heater</option>\n";
foreach($heaterData as $row){
	   $id=$row['heaterID'];
	   $name=$row['heaterName'];
	   echo "<option value=\"$id\">".$name."</option>\n";
	   }
	   ?>
      </select>
      <br><br>
      Remove Module: <select name="removeModuleID">  
	<?php
	   echo "<option value=\"NULL\">Select a Module</option>\n";
foreach($moduleData as $row){
	   $id=$row['moduleID'];
	   $name=$row['moduleName'];
	   echo "<option value=\"$id\">".$name."</option>\n";
	   }
	   ?>
      </select>
      <br><br>
      
<?php show_sensors($sensorData,$edit=1);
echo "<br>";
show_sensors($heaterData,1,"heater");
echo "<br>";
show_sensors($moduleData,1,"module");
echo "<br>";
?>
      
      <h2>Notes</h2>
      <?php echo nl2br($notes); ?>
      <br>
      <div style="width:225px;">
	<!--Notes: <input name="notes" type="text" style="float:right"><br><br>-->
	Additional Notes: <textarea cols="40" rows="5" name="notes"></textarea><br>
      </div>
      
    <h2>Pictures</h2>
    <div style="width:340px;">
      Picture File: <input name="pic" type="file" style="float:right"><br><br>
    </div>
    <div style="width:275px;">
      Picture Notes: <input name="picnotes" type="text" style="float:right"><br><br>
    </div>
    
    <h2>Misc Files</h2>
    <div style="width:340px;">
      Misc File(s): <input name="file[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
    </div>
    
    <?php echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>"; ?>
    
    <br><br>
    <input type="submit" name="submit" value="Submit">  
    </form>
    

    <input type=button onClick="location.href='index.php'" value='Index'>
    
  </body>
</html>





<script>
  function show_fields(that) {
  if (that.value == "NULL") {
  document.getElementById('thermal').style.display = "none";
  document.getElementById('heater').style.display = "none";
  document.getElementById('module').style.display = "none";
  }
  else if (that.value == "thermal") {
  document.getElementById("thermal").style.display = "block";
  document.getElementById('heater').style.display = "none";
  document.getElementById('module').style.display = "none";
  }
  else if (that.value == "heater") {
  document.getElementById("heater").style.display = "block";
  document.getElementById('thermal').style.display = "none";
  document.getElementById('module').style.display = "none";
  }
  else if (that.value == "module") {
  document.getElementById("module").style.display = "block";
  document.getElementById('heater').style.display = "none";
  document.getElementById('thermal').style.display = "none";
  }
  }
function selectChannel(that) {
    var curChannels = <?php echo $curChannels; ?>;
    var theChannel = curChannels[that.value];
    if(theChannel === null){
        document.getElementById('channel').placeholder="Not Set";
    }
    else{
        document.getElementById('channel').placeholder=theChannel;
    }
}
</script>
