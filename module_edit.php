<!DOCTYPE html>
<?php
  require_once("database.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM mock_module where id=$id";
  $data=$db->db_query($sql);
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
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title> Edit <?php echo $name; ?></title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.png" width="100" height="100" alt="CMS Logo">
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
        <h1>Edit: <?php echo $name; ?></h1>
        <form action="moduleSensorEditProc.php" method="post" enctype="multipart/form-data">
          <div style="width:400px;">
            <label for="curThickness">Thickness (Microns): </label>
        	  <input placeholder="<?php echo $si_thickness; ?>" name ="curThickness" type="number" step="0.1" style="float:right"><br><br>
            <label for="curAdhesive">Adhesive: </label>
    	      <input placeholder="<?php echo $adhesive; ?>" name ="curAdhesive" type="text" style="float:right"><br><br>
            <label for="curGeometry">Geometry: </label>
    	      <input placeholder="<?php echo $geometry; ?>" name = "curGeometry" type="text" style="float:right"><br><br>
            <h2>Notes</h2>
            <?php echo nl2br($notes); ?>
            <br>
            <div style="width:400px">
              <label for="notes">Additional Notes: </label>
              <textarea cols="40" rows="5" name="notes"></textarea>
              <br><br>
            </div>
    	    </div>
          <h2>Pictures</h2>
          <div style="width:475px;">
            <label for="pic">Picture File:</label>
            <input type="file" name="pic" style="float:right"><br><br>
          </div>
          <div style="width:400px;">
            <label for="picnotes">Picture Notes:</label>
            <input type="text" name="picnotes" style="float:right"><br><br>
          </div>
          <h2>Misc Files</h2>
          <div style="width:475px;">
            <label for="files[]">Misc File(s)</label>
            <input type="file" name="files[]" id="files" multiple="multiple" style="float:right"><br><br>
          </div>
          <?php
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
            $time = date('m-d-Y H:i:s');
            echo "<input type='hidden' name='lastEdit' value='".$time."'>";
          ?>
    	    <input class="button" type="submit" name="submit" value="Submit">
        </form>
      </main>
    </div>
  </body>
</html>
