<html>

<?php

require_once("database.php");
$db = new Database();

$id=$_GET['id'];
$sql = "SELECT * FROM test WHERE id = ".$id;
$db->query($sql);
$db->singleRecord();
$data=$db->Record;
$name=$data['name'];

$sql = "SELECT name FROM support_structure WHERE id = ".$data['assoc_ss'];
$db->query($sql);
$db->singleRecord();
$ss_name=$db->Record['name'];

#$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"test\"";
#$db->query($sql);
#$db->singleRecord();
#$notes=$db->Record['notetext'];
?>

<title>Edit <?php echo $name ?></title>

<body>
<h1>Edit <?php echo $name; ?></h1>

<?php

echo "<p>Support Structure: ".$ss_name."</p>";

?>

<h2>Misc Data</h2>
<form action="test_edit_proc.php" method="post" enctype="multipart/form-data">
   <div style="width:275px;">
     Name: <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
     
</div>


<!--
<h2>Notes</h2>

<?php echo nl2br($notes); ?>

<br>
   <div style="width:225px;">
  Notes: <input name="notes" type="text" style="float:right"><br><br>
</div>
-->

<?php echo "<input type='hidden' name='id' value='".$data['id']."'>"; ?>

<br>
   <input type="submit" name="submit" value="Submit">  
</form>

<form method="get" action="add_sensor.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Add Sensor">
</form>
<br>
<form method="get" action="test.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
	?>
  <input type="submit" value="Test Summary">
</form>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
