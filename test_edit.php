<!DOCTYPE html>
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
  <head>
    <meta charset="utf-8">
    <title>Edit Test <?php echo $name ?></title>
    <link rel="stylesheet" type="text/css" href="./style.css">
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
        </a>
      </header>
      <nav>
        <a href="part_list.php">Part List</a>
        <br>
        <a href="test_list.php">Test List</a>
        <br>
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h1>Edit Test <?php echo $name; ?></h1>
        <form method="get" action="test.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Test Summary">
        </form>
        <br>

    <!-- Add Object - select object type and display fields accordingly -->

        <label for="object_type">Add Object: </label>
        <select name="object_type" onchange="show_fields(this)">
          <option value ="NULL">Select Object Type</option>
          <option value ="thermal">Thermal Sensor</option>
          <option value ="heater">Heater</option>
          <option value ="module">Mock Module</option>
        </select>
        <br><br>
        <div id="thermal" style="display:none; width:290px;">
          <form action="add_sensor_proc.php" method="post" enctype="multipart/from-data">
            <label for="thermal_id">Add Sensor: </label>
            <select name="thermal_id" id="sensor" onchange="selectChannel(this);">
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
              foreach($sensor_data as $row) {
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
            <br>
            <input type="radio" name="let" value="inlet" onclick="isInletOutlet(this)"> Inlet
            <input type="radio" name="let" value="outlet" onclick="isInletOutlet(this)"> Outlet
            <input type="radio" name="let" value="other" checked="checked" onclick="isInletOutlet(this)"> Other
    	      <div id="position">
              <br><br>
              <label for="xpos">X Position (cm): </label>
              <input type='number' name='xpos' min='0' max='15' step='0.001' style='float:right'>
              <br><br>
              <label for="ypos">Y Position (cm): </label>
              <input type='number' name='ypos' min='0' max='15' step='0.001' style='float:right'>
    	      </div>
            <br>
            <label for="channel">Channel: </label>
            <input type="number" name="channel" min='0' step='1' id="channel" style="float:right">
            <br><br>
            <div style="font-size: .7em; font-style: italic;">
              <p>Note: If the channel is blank, the default channel will be used.</p>
            </div>
            <br><br>
            <input class="button" type="submit" name="submit" value="Add Thermal Sensor">
          </form>
        </div>
        <div id="heater" style="display:none; width:290px;">
          <form action="add_heater_proc.php" method="post" enctype="multipart/from-data">
            <label for="heater_id">Add Heater: </label>
            <select name="heater_id" id="heater">
              <?php
                $notstr="";
                if (count($heaterData)) {
                  $notstr=" WHERE id != 0";
                  foreach ($heaterData as $ids) {
                    if($ids['heaterID']) {
                      $notstr.=" AND id != ".$ids['heaterID'];
                    }
                  }
                }
                echo "<option value=\"NULL\">Select a Heater</option>\n";

                $sql="SELECT name,id FROM heater".$notstr;
                $heater_data=db_query($sql,$db);
                foreach ($heater_data as $row) {
                  $hid=$row['id'];
                  $heater_name=$row['name'];
                  echo "<option value=\"$hid\">".$heater_name."</option>\n";
                }
                echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
              ?>
            </select>
    	      <br><br>
            <label for="xpos">X Position (cm): </label>
            <input type="text" name="xpos" style="float:right">
            <br><br>
            <label for="ypos">Y Position (cm): </label>
            <input type="text" name="ypos" style="float:right">
            <br><br>
            <input class="button" type="submit" name="submit" value="Add Heater">
          </form>
        </div>
        <div id="module" style="display:none; width:290px;">
          <form action="add_module_proc.php" method="post" enctype="multipart/from-data">
            <label for="module_id">Add Module: </label>
            <select name="module_id" id="module">
              <?php
                $notstr="";
                if (count($moduleData)) {
                  $notstr=" WHERE id != 0";
                  foreach ($moduleData as $ids) {
                    if ($ids['moduleID']) {
                      $notstr.=" AND id != ".$ids['moduleID'];
                    }
                  }
                }
                echo "<option value=\"NULL\">Select a Module</option>\n";

                $sql="SELECT name,id FROM mock_module".$notstr;
                $heater_data=db_query($sql,$db);
                foreach ($heater_data as $row) {
                  $id=$row['id'];
                  $module_name=$row['name'];
                  echo "<option value=\"$id\">".$module_name."</option>\n";
                }
                echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
              ?>
            </select>
    	       <br><br>
             <label for="xpos">X Postition (cm): </label>
             <input type="text" name="xpos" style="float:right">
             <br><br>
             <label for="ypos">Y Position (cm): </label>
             <input type="text" name="ypos" style="float:right">
             <br><br>
             <input class="button" type="submit" name="submit" value="Add Module">
           </form>
         </div>
         <form action="test_edit_proc.php" method="post" enctype="multipart/form-data">
          <div style="width:275px;">
            <h2>Misc Data</h2>
            <label for="name">Name: </label>
            <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
            <label for="coolant_temp">Coolant <br>Temp (&deg;C): </label>
            <input placeholder= "<?php echo $coolantTemp; ?>" name="coolant_temp" type="text" style="float:right"><br><br>
          </div>
          <h2>Object Data</h2>
          Remove Sensor: <select name="removeSensorID">
          <?php
            echo "<option value=\"NULL\">Select a Sensor</option>\n";
            foreach ($sensorData as $row) {
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
              foreach ($heaterData as $row) {
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
              foreach ($moduleData as $row) {
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
          <label for="notes">Additional Notes: </label>
          <textarea cols="40" rows="5" name="notes"></textarea><br>
        </div>

          <h2>Pictures</h2>
          <div style="width:340px;">
          <label for="pic">Picture File: </label>
          <input name="pic" type="file" style="float:right"><br><br>
        </div>
          <div style="width:275px;">
          <label for="picnotes">Picture Notes: </label>
          <input name="picnotes" type="text" style="float:right"><br><br>
        </div>

          <h2>Misc Files</h2>
          <div style="width:340px;">
            <label for="file[]">Misc File(s): </label>
            <input name="file[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
          </div>
          <?php echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>"; ?>
      </main>
    </div>
  </body>
</html>
<script>
  function show_fields(that) {
    if (that.value == "NULL") {
      document.getElementById('thermal').style.display = "none";
      document.getElementById('heater').style.display = "none";
      document.getElementById('module').style.display = "none";
    } else if (that.value == "thermal") {
      document.getElementById("thermal").style.display = "block";
      document.getElementById('heater').style.display = "none";
      document.getElementById('module').style.display = "none";
    } else if (that.value == "heater") {
      document.getElementById("heater").style.display = "block";
      document.getElementById('thermal').style.display = "none";
      document.getElementById('module').style.display = "none";
    } else if (that.value == "module") {
      document.getElementById("module").style.display = "block";
      document.getElementById('heater').style.display = "none";
      document.getElementById('thermal').style.display = "none";
    }
  }
  function selectChannel(that) {
    var curChannels = <?php echo $curChannels; ?>;
    var theChannel = curChannels[that.value];
    if (theChannel === null) {
      document.getElementById('channel').placeholder="Not Set";
    } else{
      document.getElementById('channel').placeholder=theChannel;
    }
  }
  function isInletOutlet(that) {
    if (that.value == "inlet") {
      //document.getElementById("position").innerHTML = "hello";
      const str = "<input type='hidden' name='xpos' value='7.5'> <input type='hidden' name='ypos' value='17'>";
      document.getElementById("position").innerHTML = str;
    } else if (that.value == "outlet") {
      //document.getElementById("position").innerHTML = "world";
      const str = "<input type='hidden' name='xpos' value='7.5'> <input type='hidden' name='ypos' value='-2'>"
      document.getElementById("position").innerHTML = str;
    } else {
      //document.getElementById("position").innerHTML = "!!!";
      const str = "<br><br>X Position (cm): <input type='number' name='xpos' min='0' max='15' step='0.001' style='float:right'><br><br>Y Position (cm): <input type='number' name='ypos' min='0' max='15' step='0.001' style='float:right'><br>";
      document.getElementById("position").innerHTML = str;
    }
  }
</script>
