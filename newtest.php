<html>
<head>
<title>Submit New Test</title>

<body>
<h1>Submit New Test</h1>

<?php

require_once("database.php");
$db = new Database();
?>

<form action="newtest_proc.php" method="post" enctype="multipart/form-data">
   <div style="width:300px;">
  Test Name: <input name="name" type="text" style="float:right"><br><br>
  Support Structure: <select name='support_structure'>
<?php
	$sql = "SELECT name,id FROM support_structure ORDER BY name ASC";
	$db->query($sql);
	echo "<option value=\"NULL\">Select a Support Structure</option>\n";
	while($db->nextRecord()){
	$id = $db->Record['id'];
	$name = $db->Record['name'];
	echo "<option value=\"$id\">".$name."</option>\n";
	}	
?>
</select>

<br><br>
</div>






   <input type="submit" name="submit" value="Submit">  
</form>





<?php

?>

<input type=button onClick="location.href='index.php'" value='Index'>
</body>
</html>
