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
    <title>Edit <?php echo $name; ?></title>
  </head>
  <body>
    <h1>Edit <?php echo $name; ?></h1>
    <p>Type: <?php echo $data['sensor_type']; ?></p>
    <form action="thermal_sensor_edit_proc.php" method="post" enctype="multipart/form-data">
      <div style="width:300px;">
        Current Channel: <input placeholder= "<?php echo $data['cur_channel']; ?>" name="cur_channel" type="number" step="1" min="100" style="float:right"><br><br>
        <h2>Notes</h2>
        <?php echo nl2br($notes); ?>
        <br>
        <div style="width:225px">
          Additional Notes: <textarea cols="40" rows="5" name="notes"></textarea><br><br>
        </div>
      </div>
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" name="submit" value="Submit">  
    </form>   
    <br><br>
    <form method="get" action="thermal_sensor.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Part Summary">
    </form>

    <input type=button onClick="location.href='part_list.php'" value='Part List'>
    <br><br>
    <input type=button onClick="location.href='index.php'" value='Index'>
    </body>
  </head>
</html>
