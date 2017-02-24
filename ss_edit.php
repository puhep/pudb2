<html>
<?php

require_once("database.php");
$db = new Database();

$id=$_GET['id'];
$sql = "SELECT * FROM support_structure WHERE id = ".$id;
$db->query($sql);
$db->singleRecord();
$data=$db->Record;
$name=$data['name'];

$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"support_structure\"";
$db->query($sql);
$db->singleRecord();
$notes=$db->Record['notetext'];
?>


<head>
<title>Edit <?php echo $name ?></title>

<body>
<h1>Edit <?php echo $name; ?></h1>

<form method="get" action="ss_summary.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  <input type="submit" value="Part Summary">
   </form>

<h2>Misc Data</h2>
<form action="ss_edit_proc.php" method="post" enctype="multipart/form-data">
   <div style="width:300px;">
  Name: <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
  Mass: <input placeholder= "<?php echo $data['mass']; ?>" name="mass" type="text" style="float:right"><br><br>
  Pipe <br>Material: <input placeholder= "<?php echo $data['pipe_material']; ?>" name="pipe_material" type="text" style="float:right"><br><br>
  Pipe Wall <br>Thickness: <input placeholder= "<?php echo $data['pipe_wall_thickness']; ?>" name="pipe_wall_thickness" type="text" style="float:right"><br><br>
  Foam Type: <input placeholder= "<?php echo $data['foam_type']; ?>" name="foam_type" type="text" style="float:right"><br><br>
  Ply of <br>Wings: <input placeholder= "<?php echo $data['wings_ply']; ?>" name="wings_ply" type="text" style="float:right"><br><br>
  Stack of <br>Airex: <input placeholder= "<?php echo $data['airex_stack']; ?>" name="airex_stack" type="text" style="float:right"><br><br>



</div>



<h2>Notes</h2>

<?php echo nl2br($notes); ?>

<br>
   <div style="width:225px;">
  Notes: <input name="notes" type="text" style="float:right"><br><br>
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
Misc File: <input name="file" type="file" style="float:right"><br><br>
</div>

<?php echo "<input type='hidden' name='id' value='".$data['id']."'>"; ?>

<br>
   <input type="submit" name="submit" value="Submit">  
</form>

<br>




<br><br>
<input type=button onClick="location.href='part_list.php'" value='Part List'>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
