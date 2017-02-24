<html>
<?php
require_once("database.php");

function show_files($part_type, $part_id){
	 $dir = "./files/".$part_type."/".$part_id;
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

function show_pictures($part_type, $part_id){
	 $dir = "./pics/".$part_type."/".$part_id;
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

function show_sensors($data){
   echo "<table border=1 cellpadding=5>";
   echo "<th>Sensor Name</th>";
   echo "<th>X</th>";
   echo "<th>Y</th>";
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
   echo "</tr>";
   }
   echo "</table>";
}



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
