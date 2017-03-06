<html>
<?php
require_once("database.php");
require_once("functions.php");
$id=$_GET['id'];
$db= new Database();
$sql="SELECT * FROM thermal_sensor where id=$id";
$data=db_query($sql,$db);
$data=$data[0];
$name=$data['name'];     
?>
  <head>
    <title><?php echo $name; ?> Summary</title>
    <body>
      <h1><?php echo $name; ?> Summary</h1>
      <p>Sensor Type: <?php echo $data['sensor_type']; ?></p>
      <p>Current Channel: <?php echo $data['cur_channel']; ?></p>
      <br><br>
<form method="get" action="thermal_sensor_edit.php">
  <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  <input type="submit" value="Edit Part">
   </form>
      <input type=button onClick="location.href='part_list.php'" value='Part List'>
      <br><br>
      <input type=button onClick="location.href='index.php'" value='Index'>
    </body>

</html>
