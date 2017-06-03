<!DOCTYPE html>
<?php
  require_once("database.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM thermal_sensor where id=$id";
  $data=$db->db_query($sql);
  $data=$data[0];
  $name=$data['name'];

  $sql="SELECT notetext FROM notes where part_id=$id and part_type=\"thermal_sensor\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purude University Logo">
          <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
        </a>
      </header>
      <nav>
        <a href="part_list.php">Part List</a>
        <br>
        <a href="test_list.php">Test List</a>
        <br>
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h1><?php echo $name; ?> Summary</h1>
        <span>Last Edited:
          <?php
            if ($data['lastEdit'] != "") {
              echo $data['lastEdit'];
            } else {
              echo "Not yet recorded";
            }
          ?>
        </span>
        <?php
          echo
            "<table border=1 cellpadding=5>".
              "<tr><td>Object Type</td><td>Thermal Sensor</td></tr>".
              "<tr><td>Sensor Type</td><td>".$data['sensor_type']."</td></tr>".
              "<tr><td>Current Chanel</td><td>".$data['cur_channel']."</td></tr>".
            "</table><br>";
        ?>
        <form method="get" action="thermal_sensor_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Edit Part">
        </form>
        <h2>Notes</h2>
        <?php
          if ($notes != "") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
        ?>
        <br>
      </main>
    </div>
  </body>
</html>
