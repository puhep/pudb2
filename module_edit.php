<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM mock_module where id=$id";
  $data=db_query($sql,$db);
  $data=$data[0];
  $name=$data['name'];
  $si_thickness=$data['si_thickness'];
  $adhesive=$data['adhesive'];
  $geometry=$data['geometry'];

  $sql="SELECT notetext FROM notes where part_id=$id and part_type=\"mock_module\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> Edit <?php echo $name; ?></title>
  </head>
  <body>
    <a href="index.php">
      <div class="header">
        <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
        <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
      </div>
    </a>
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
    <div class="content">
      <h1>Edit: <?php echo $name; ?></h1>
      <form action="moduleSensorEditProc.php" method="post" enctype="multipart/form-data">
        <div style="width:300px;">
          <label for="curThickness">Thickness: </label>
      	  <input placeholder="<?php echo $si_thickness; ?>" name ="curThickness" type="number" step="0.1" style="float:right"><br><br>
          <label for="curAdhesive">Adhesive: </label>
  	      <input placeholder="<?php echo $adhesive; ?>" name ="curAdhesive" type="text" style="float:right"><br><br>
          <label for="curGeometry">Geometry: </label>
  	      <input placeholder="<?php echo $geometry; ?>" name = "curGeometry" type="text" style="float:right"><br><br>
          <h2>Notes</h2>
          <?php echo nl2br($notes); ?>
          <br>
          <div style="width:225px">
            <label for="notes">Additional Notes: </label>
            <textarea cols="40" rows="5" name="notes"></textarea>
            <br><br>
          </div>
  	    </div>
  	    <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
  	    <input class="button" type="submit" name="submit" value="Submit">
      </form>
    </div>
  </body>
</html>
