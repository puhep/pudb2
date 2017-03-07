<?php
require_once("database.php");
require_once("functions.php");
$id=$_GET['id'];
$db= new Database();
$data=db_query("SELECT * FROM mock_module where id=$id",$db);
$data=$data[0];
$name=$data['name'];     
?>
<html>
  <head>
    <title><?php echo $name; ?> Summary</title>
    <body>
      <h1><?php echo $name; ?> Summary</h1>
<p>Object Type: Mock Module</p><p>Name: <?php echo $name; ?></p>
      <br><br>
<!--<form method="get" action="thermal_sensor_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  <input type="submit" value="Edit Part">
   </form>
                          -->
      <input type=button onClick="location.href='part_list.php'" value='Part List'>
      <br><br>
      <input type=button onClick="location.href='index.php'" value='Index'>
    </body>

</html>