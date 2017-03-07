<?php
require_once("database.php");
require_once("functions.php");
$id=$_GET['id'];
$db= new Database();
$data=db_query("SELECT * FROM sheet where id=$id",$db);
$data=$data[0];
$name=$data['name'];
$sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
$db->query($sql);
$db->singleRecord();
$notes=$db->Record['notetext'];
?>
<html>
  <head>
    <title><?php echo $name; ?> Summary</title>
    <body>
      <h1><?php echo $name; ?> Summary</h1>
<p>Object Type: Sheet</p><p>Name: <?php echo $name; ?></p>
<?php
echo "<p>Ply: ".$data['ply']."</p>";
echo "<p>Mass before backing (g): ".$data['mass_nb']."</p>";
echo "<p>Cut by: ".$data['user_cut']."</p>";
echo "<p>Bagged by: ".$data['user_bagged']."</p>";
echo "<p># of wax coats: ".$data['num_wax_coats']."</p>";
echo "<p>Curing stackup: ".$data['curing_stackup']."</p>";
echo "<p>Checked (1) by: ".$data['user_check1']."</p>";
echo "<p>Ramped up by: ".$data['user_ramp']."</p>";
echo "<p>Checked (2) by: ".$data['user_check2']."</p>";
echo "<p>Checked (3) by: ".$data['user_check3']."</p>";
echo "<p>Removed by: ".$data['user_remove']."</p>";
echo "<p>Mass after (g): ".$data['mass_after']."</p>";
echo "<p>Measured by: ".$data['user_measure']."</p>";

#echo "<p>Ply: ".$data['ply']."</p>";

echo "<h2>Notes</h2>";
if($notes!=""){
   echo "<p>".nl2br($notes)."</p>";
   }
   else{
   echo "No notes found";
   }
echo "<h2>Pictures</h2>";
show_pictures("sheet",$id);

echo "<h2>Misc Files</h2>";
show_files("sheet",$id);

?>
      <br><br>
<form method="get" action="sheet_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  <input type="submit" value="Edit Part">
   </form>
      <input type=button onClick="location.href='part_list.php'" value='Part List'>
      <br><br>
      <input type=button onClick="location.href='index.php'" value='Index'>
    </body>

</html>