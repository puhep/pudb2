<html>
<head>
<title>Part List</title>

<body>
<h1>Part List</h1>

<?php
require_once("database.php");
$db = new Database();
$sql = "SELECT * FROM support_structure";
$db->query($sql);
$i=0;
$ss=array();
while($db->nextRecord()){
$ss[$i] = $db->Record;
$i++;
}
$sql = "SELECT * FROM thermal_sensor";
$db->query($sql);
$i=0;
$ts=array();
while($db->nextRecord()){
$ts[$i] = $db->Record;
$i++;
}

echo "<table border=0 cellpadding=10 val=aligntop>";
echo "<tr valign=top><td>";
echo "<table border=1>";
echo "<tr><th>Support Structures</th></tr>";
foreach($ss as $structure){
  echo "<tr><td>";
      echo "<a href=\"ss_summary.php?id=$structure[0]\">$structure[1]</a>";
      echo "</td></tr>";
}
	echo "</table><br>";
      
  #    echo "</td><td>";
 echo "</td><td>";     
echo "<table border=1>";
echo "<tr><th>Thermal Sensors</th></tr>";
foreach($ts as $sensor){
  echo "<tr><td>";
      echo $sensor['name'];
      echo "</td></tr>";
}
	echo "</table><br>";

 echo "</td></tr>";     
  echo "</table>";
?>

<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
