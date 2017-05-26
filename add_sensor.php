<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $db = new Database();
  $id=$_GET['id'];
  $data = test_data($id,$db);
  $notstr="";
  if (count($data)) {
    $notstr=" WHERE id != 0";
    foreach ($data as $ids) {
      if ($ids['sid']) {
        $notstr.=" AND id != ".$ids['sid'];
      }
    }
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add Sensor to <?php echo $data[0]['tname']; ?></title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.html">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
        </a>
      </header>
      <nav>
        <a href="part_list.php">Part List</a>
        <br>
        <a href="test_list.php">Test List</a>
        <br>
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing" target="_blank"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing" target="_blank">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h1>Add Sensor to <?php echo $data[0]['tname']; ?></h1>
        <?php show_sensors($data); ?>
        <br>
        <form action="add_sensor_proc.php" method="post" enctype="multipart/from-data">
          <div style="width:290px;">
            <label for="thermal_id">Sensor: </label>
            <select name="thermal_id">
              <?php
                echo "<option value=\"NULL\">Select a Sensor</option>\n";
                $sql="SELECT name,id FROM thermal_sensor".$notstr;
                $sensor_data=db_query($sql,$db);
                foreach ($sensor_data as $row) {
                    $id=$row['id'];
                    $name=$row['name'];
                    echo "<option value=\"$id\">".$name."</option>\n";
                }
                echo "<input type='hidden' name='test_id' value='".$_GET['id']."'>";
              ?>
              </select>
            <br><br>
            <label for="xpos">X Position (cm): </label>
            <input type="text" name="xpos" style="float:right">
            <br><br>
            <label for="ypos">Y Position (cm): </label>
            <input type="text" name="ypos" style="float:right">
    	      <br><br>
            <label for="channel">Channel: </label>
            <input type="text" name="channel" style="float:right">
            <br><br>
          </div>
    	   <input class="button" type="submit" name="submit" value="Submit">
        </form>
        <form method="get" action="test_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input type="submit" value="Edit Data">
        </form>
        <br>
        <form method="get" action="test.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input type="submit" value="Test Summary">
        </form>
      </main>
    </div>
  </body>
</html>
