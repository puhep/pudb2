<html>
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
        while(false !== ($entry=readdir($handle))){
            if($entry != "." && $entry != ".." && substr($entry,-3) !="txt"){
                echo "<tr>";
                echo "<td>";
                echo "<a href=$dir/$entry target=\"blank\"> <img src=\"$dir/$entry\" width=\"200\" height=\"200\"></a>";
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
            echo "<input placeholder=\"".$row['channel']."\" name=\"channel[$i]\" type=\"text\" >";
            echo "</td>";
            echo "</tr>";
            echo "<input type='hidden' name=\"thermal_id[$i]\" value='".$row['sid']."'>";
            $i++;
        }
        echo "</table>";
    }
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
</html>
