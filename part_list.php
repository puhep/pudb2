<html>
<head>
<title>Part List</title>

<body>
<h1>Part List</h1>

</html>
<?php
require_once("database.php");
require_once("functions.php");

$db = new Database();

$ss=db_query("SELECT * FROM support_structure",$db);

$ts = db_query("SELECT * FROM thermal_sensor",$db);

$heaters=db_query("SELECT * FROM heater",$db);

$modules=db_query("SELECT * FROM mock_module",$db);

$sheets=db_query("SELECT * FROM sheet",$db);

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
    echo "<a href=\"thermal_sensor.php?id=$sensor[0]\">$sensor[1]</a>";
    echo "</td></tr>";
}
echo "</table><br>";

echo "</td>";

echo "<td>";
echo "<table border=1>";
echo "<th>Heaters</th>";
foreach($heaters as $heater){
	echo "<tr><td>";
    echo "<a href=\"heater.php?id=$heater[0]\">$heater[1]</a>";
    echo "</td></tr>";
}
echo "</table><br>";
echo "</td>";

echo "<td>";
echo "<table border=1>";
echo "<th>Mock Modules</th>";
foreach($modules as $module){
	echo "<tr><td>";
    echo "<a href=\"module.php?id=$module[0]\">$module[1]</a>";
    echo "</td></tr>";
}
echo "</table><br>";
echo "</td>";

echo "<td>";
echo "<table border=1>";
echo "<th>Sheets</th>";
foreach($sheets as $sheet){
	echo "<tr><td>";
    echo "<a href=\"sheet.php?id=$sheet[0]\">$sheet[1]</a>";
    echo "</td></tr>";
}
echo "</table><br>";
echo "</td>";

echo "</tr>";

echo "</table>";
?>


<html>
<input type=button onClick="location.href='index.php'" value='Index'>
<br><br>

</body>
</html>