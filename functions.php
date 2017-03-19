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
function show_sensors($data, $edit=0){
    if($edit==0){
        echo "<table border=1 cellpadding=5>";
        echo "<th>Sensor</th>";
        echo "<th>X (cm)</th>";
        echo "<th>Y (cm)</th>";
        echo "<th>Channel</th>";
        foreach($data as $row){
            echo "<tr>";
            echo "<td>";
            echo $row['name'];
            echo "</td>";
            echo "<td>";
            echo $row['xpos'];
            echo "</td>";
            echo "<td>";
            echo $row['ypos'];
            echo "</td>";
            echo "<td>";
            echo $row['channel'];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<table border=1 cellpadding=5>";
        echo "<th>Sensor</th>";
        echo "<th>X (cm)</th>";
        echo "<th>Y (cm)</th>";
        echo "<th>Channel</th>";
        $i=0;
        foreach($data as $row){
            echo "<tr>";
            echo "<td>";
            echo $row['name'];
            echo "</td>";
            echo "<td>";
            echo "<input placeholder=\"".$row['xpos']."\" name=\"xpos[$i]\" type=\"text\" >";
            echo "</td>";
            echo "<td>";
            echo "<input placeholder=\"".$row['ypos']."\" name=\"ypos[$i]\" type=\"text\" >";
            echo "</td>";
            echo "<td>";
            if($row['channel'] == "" and $row['cur_channel'] != ""){ $row['channel'] = $row['cur_channel']." (Default)"; }
            echo "<input placeholder=\"".$row['channel']."\" name=\"channel[$i]\" type=\"text\" >";
            echo "</td>";
            echo "</tr>";
            echo "<input type='hidden' name=\"thermal_id[$i]\" value='".$row['sid']."'>";
            $i++;
        }
        echo "</table>";
    }
}

function add_file($type,$id,$files){;
    $targetdir = "../phase_2/files/$type/$id/";
    ### if the directory for the structure does not exist, create it and make it editable
    if(!file_exists($targetdir)){
        mkdir($targetdir);
        chmod($targetdir,0777);
    }
    #echo $targetdir."<br><br>";
    foreach($files['name'] as $f => $name){
        $targetfile = $targetdir.$name;
        echo $targetfile."<br>";
        print_r($files['tmp_name']);
        echo "<br>";
        if(!move_uploaded_file($files['tmp_name'][$f], $targetfile)){
            echo "Sorry, an error has occurred. Try again or bother Greg until he helps<br>";
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

### another function written as shorthand. this complex sql query is used on several different pages
### it also requires edits as the data evolves
function test_data($id,$db){
    $sql="SELECT t.name as tname,t.id,t.coolant_temp,
s.*,s.id as sid, s.cur_channel as cur_channel,
ss.id as ssid,ss.name as ss_name,
st.xpos,st.ypos,st.channel 
FROM test t 
LEFT JOIN sensor_test st ON st.test_id=t.id 
LEFT JOIN thermal_sensor s ON st.thermal_id=s.id 
LEFT JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=".$id;
       $data = db_query($sql,$db);
       return $data;
}

### shorthand to make some of the other pages a little more readable
### if the query returns only one line, it can be accessed with $data[0]
function db_query($sql,$db){
    $db->query($sql);
    $i=0;
    while($db->nextRecord()){
        $data[$i]=$db->Record;
        $i++;
    }
    return $data;
}

?>
