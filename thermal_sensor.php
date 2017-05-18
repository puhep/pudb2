<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM thermal_sensor where id=$id";
  $data=db_query($sql,$db);
  $data=$data[0];
  $name=$data['name'];

  $sql="SELECT notetext FROM notes where part_id=$id and part_type=\"thermal_sensor\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <a href="index.php">
      <div class="header">
        <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purude University Logo">
        <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
      </div>
    </a>
    <h1><?php echo $name; ?> Summary</h1>
    <p>Sensor Type: <?php echo $data['sensor_type']; ?></p>
    <p>Current Channel: <?php echo $data['cur_channel']; ?></p>
    <h2>Notes</h2>
    <?php
      if($notes != "") {
        echo "<p>".nl2br($notes)."</p>";
      } else {
        echo "No notes found";
      }
    ?>
    <br><br>
    <form method="get" action="thermal_sensor_edit.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Edit Part">
    </form>
    <br><br>
    <input type=button onClick="location.href='part_list.php'" value='Part List'>
  </body>
</html>
