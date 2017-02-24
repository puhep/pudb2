
<html>

<?php
   require_once("database.php");
   require_once("functions.php");

$id=$_GET['id'];
$db=new Database();
$sql="SELECT * FROM support_structure where id=$id";
$db->query($sql);
$db->singleRecord();
$data=$db->Record;
$name=$data['name'];

$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"support_structure\"";
$db->query($sql);
$db->singleRecord();
$notes=$db->Record['notetext'];

$sql = "SELECT name,id FROM test where assoc_ss=".$id;
$db->query($sql);
$i=0;
while($db->nextRecord()){
$tests[$i]=$db->Record;
$i++;
}
?>



<head>
<title><?php echo $name; ?> Summary</title>

<body>
<h1><?php echo $name; ?> Summary</h1>

<form method="get" action="ss_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  <input type="submit" value="Edit Part">
   </form>


<?php
   #echo "<a href=\"ss_edit.php?id=".$id."\">Edit Part</a>";
     
   echo "<h2>Misc Data</h2>";
   echo "<p>ID: ".$id."</p>";
   echo "<p>Name: ".$name."</p>";
   echo "<p>Mass: ".$data['mass']."</p>";;
   echo "<p>Pipe Material: ".$data['pipe_material']."</p>";
   echo "<p>Pipe Wall Thickness: ".$data['pipe_wall_thickness']."</p>";
   echo "<p>Foam Type: ".$data['foam_type']."</p>";
   echo "<p>Ply of Wings: ".$data['wings_ply']."</p>";
   echo "<p>Stack of Airex: ".$data['airex_stack']."</p>";
   
echo "<h2>Associated Tests</h2>";
   if(isset($tests)){
   foreach($tests as $row)
   {
   echo "<a href='test.php?id=".$row['id']."' >".$row['name']."</a><br>";
   #echo $row['name']."<br>";
   }
   }
   else{
   echo "No tests found";
   }
   
echo "<h2>Notes</h2>";
if($notes!=""){
   echo "<p>".nl2br($notes)."</p>";
   }
   else{
   echo "No notes found";
   }
echo "<h2>Pictures</h2>";
show_pictures("support_structure",$id);

echo "<h2>Misc Files</h2>";
show_files("support_structure",$id);


?>

<br><br>
<input type=button onClick="location.href='part_list.php'" value='Part List'>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
