<?php
require_once("database.php");

### displays a list of files associated with a part as downloadable links
### generalizable to any part type
function show_files($part_type, $part_id){
    $dir = "../phase_2/files/".$part_type."/".$part_id;
    if(!file_exists($dir)){
		echo "No files found <br>";
		return;
    }
	if(file_exists($dir) && ($handle = opendir($dir))){

		while(false !== ($entry=readdir($handle))){

			if($entry != "." && $entry != ".."){

				echo "<a href=\"$dir/$entry\" target=\"_blank\">$entry</a>";
				echo "<br>";

			}
		}
	}

}

### show all pictures with their associated comments for a part in a table
### generalizable for any part type
function show_pictures($part_type, $part_id){
    $dir = "../phase_2/pics/".$part_type."/".$part_id;
    if(!file_exists($dir)){
		echo "No pictures found <br>";
		return;
    }
    if(file_exists($dir) && ($handle = opendir($dir))){
        echo "<table border=1>";
        while(false !== ($entry=(readdir($handle)))){
            if($entry != "." && $entry != ".." && substr($entry,-3) !="txt"){
                $str = rawurlencode($entry);
                echo "<tr>";
                echo "<td>";
                echo "<a href=$dir/$str target=\"blank\"> <img src=\"$dir/$entry\" width=\"200\" height=\"200\"></a>";
                echo "</td>";
                echo "<td>";
                $txt = $dir."/".substr($entry,0,-3)."txt";
                if(file_exists($txt)){
                    $fp = fopen($txt, 'r');
                    echo nl2br(fread($fp, filesize($txt)));
                    fclose($fp);
                }
                #echo "picture text here";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
}
### show the sensors for a test in a table. On the edit page, make the fields
### editable with placeholders for the current values
function show_sensors($data, $edit=0, $type="sensor"){
    if($edit==0){
        echo "<table border=1 cellpadding=5>";
        echo "<th>".ucfirst($type)."</th>";
        echo "<th>X (cm)</th>";
        echo "<th>Y (cm)</th>";
        if($type=="sensor"){ echo "<th>Channel</th>"; }
        foreach($data as $row){
            echo "<tr>";
            echo "<td>";
            echo $row[$type."Name"];
            echo "</td>";
            echo "<td>";
            echo $row[$type."XPos"];
            echo "</td>";
            echo "<td>";
            echo $row[$type.'YPos'];
            echo "</td>";
            if($type=="sensor"){
                echo "<td>";
                echo $row['sensorChannel'];
                echo "</td>"; }
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<table border=1 cellpadding=5>";
        echo "<th>".ucfirst($type)."</th>";
        echo "<th>X (cm)</th>";
        echo "<th>Y (cm)</th>";
        $i=0;
        if($type=="sensor"){ echo "<th>Channel</th>"; }
        foreach($data as $row){
            echo "<tr>";
            echo "<td>";
            echo $row[$type.'Name'];
            echo "</td>";
            echo "<td>";
            echo "<input placeholder=\"".$row[$type.'XPos']."\" name=\"".$type."XPos[$i]\" type=\"number\" step=\"0.1\" >";
            echo "</td>";
            echo "<td>";
            echo "<input placeholder=\"".$row[$type.'YPos']."\" name=\"".$type."YPos[$i]\" type=\"number\" step=\"0.1\" >";
            echo "</td>";
            if($type=="sensor"){
                echo "<td>";
                if($row['sensorChannel'] == "" and $row['curChannel'] != ""){ $row['sensorChannel'] = $row['curChannel']." (Default)"; }
                echo "<input placeholder=\"".$row['sensorChannel']."\" name=\"channel[$i]\" type=\"number\" >";
                echo "</td>";
                echo "</tr>"; }
            if($type=="sensor"){ $nameType = "thermal"; }
            else{ $nameType = $type; }
            echo "<input type='hidden' name=\"".$nameType."_id[$i]\" value='".$row[$type.'ID']."'>";
            $i++;
        }
        echo "</table>";
    }
}

function addTempVsTimeFile($type, $id, $file) {
  $directory = "../phase_2/files/$type/$id/";
  // echo $directory."<br><br>";
  if (!file_exists($directory)) {
    mkdir($directory);
    chmod($directory, 0777);
  }

  $targetFile = $directory.$file['name'];

  $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);
  if($fileType != "csv") {
    echo "Sorry, only CSV file type is allowed currently for Temp vs Time.<br>".$backmessage;
  }

  $targetFile = $directory."tempVsTime.csv";
  // print_r($file);
  // echo $file['tmp_name']."<br>".$file['name'];
  if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
    echo "<br>no good";
  } else {
    // echo "it worked.";
  }
}

function add_file($type,$id,$files) {
  $targetDir = "../phase_2/files/$type/$id/";
  ### if the directory for the structure does not exist, create it and make it editable
  if (!file_exists($targetDir)) {
    mkdir($targetDir);
    chmod($targetDir,0777);
  }
  for ($i = 0; $i < sizeof($files['name']); $i++) {
    $targetFile = $targetDir.$files['name'][$i];
    if (!move_uploaded_file($files['tmp_name'][$i], $targetFile)) { // If file fails to upload send error message
      echo "<h2>Sorry, an error has occurred. Try again or bother Greg & Chase until they help</h2><br>";
    }
  }
}

function add_pic($type,$id,$files,$notes){
    $picupload=1;
    #echo "pic detected<br>";
    $targetdir = "../phase_2/pics/$type/$id/";
    $targetfile = $targetdir.$files['pic']['name'];
    $imageFileType = pathinfo($targetfile,PATHINFO_EXTENSION);
    ### if the directory for the test does not exist, create it and make it editable
    if(!file_exists($targetdir)){
      mkdir($targetdir);
      chmod($targetdir,0777);
	  }
    ### don't allow duplicate uploads
    if(file_exists($targetfile)){
      echo "Sorry, file already exists.<br>".$backmessage;
      $picupload = 0;
    }
    ### only picture type files are allowed
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>".$backmessage;
      $picupload = 0;
    }
    ### if none of the errors have been detected, proceed with the upload
    if($picupload==1){
    #echo "ok to upload";
    move_uploaded_file($files['pic']['tmp_name'], $targetfile);
    $fp = fopen(substr($targetfile,0,-3)."txt","w");
    $date = date("m-d-y H:i:s");
    #echo $date;
    fwrite($fp,$date." ".$notes."\n");
    fclose($fp);
    }
}

### shorthand to make some of the other pages a little more readable
### if the query returns only one line, it can be accessed with $data[0]
#function db_query($sql,$db){
#    $db->query($sql);
#    $i=0;
#    while($db->nextRecord()){
#        $data[$i]=$db->Record;
#        $i++;
#    }
#    return $data;
#}

function testData2($testID,$db){
    $sql = "SELECT t.name as testName, t.id as testID, t.coolant_temp as coolantTemp,
ss.id as ssID, ss.name as ssName
FROM test t
LEFT JOIN support_structure ss ON t.assoc_ss=ss.id
WHERE t.id=".$testID;
    $data = $db->db_query($sql);
    return $data[0];
}

function sensorTestData($testID,$db){
    $sql = "SELECT s.id as sensorID, s.name as sensorName, s.cur_channel as curChannel,
st.xpos as sensorXPos, st.ypos as sensorYPos, st.channel as sensorChannel
FROM test t
LEFT JOIN sensor_test st ON st.test_id=t.id
LEFT JOIN thermal_sensor s ON st.thermal_id=s.id
WHERE t.id=".$testID;
    $sensorData = $db->db_query($sql);
    return $sensorData;
}

function heaterTestData($testID,$db){
    $sql = "SELECT h.id as heaterID, h.name as heaterName,
ht.xpos as heaterXPos, ht.ypos as heaterYPos
FROM test t
LEFT JOIN heater_test ht ON ht.test_id=t.id
LEFT JOIN heater h ON ht.heater_id=h.id
WHERE t.id=".$testID;
    $heaterData = $db->db_query($sql);
    return $heaterData;
}

function moduleTestData($testID,$db){
    $sql = "SELECT m.id as moduleID, m.name as moduleName,
mt.xpos as moduleXPos, mt.ypos as moduleYPos
FROM test t
LEFT JOIN module_test mt ON mt.test_id=t.id
LEFT JOIN mock_module m ON mt.module_id=m.id
WHERE t.id=".$testID;
    $moduleData = $db->db_query($sql);
    return $moduleData;
}

?>
