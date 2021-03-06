<?php
  require_once("database.php");
  $db = new Database();
  $id=$_GET['id'];
  $sql = "SELECT * FROM support_structure WHERE id = ".$id;
  $db->query($sql);
  $db->singleRecord();
  $data=$db->Record;
  $name=$data['name'];

  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"support_structure\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title>Edit <?php echo $name ?></title>
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
        <h1>Edit <?php echo $name; ?></h1>
        <form method="get" action="ss_summary.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Part Summary">
        </form>
        <h2>Misc Data</h2>
        <form action="ss_edit_proc.php" method="post" enctype="multipart/form-data">
          <div style="width:400px;">
            <label for="name">Name: </label>
            <input placeholder= "<?php echo $name; ?>" name="name" type="text" style="float:right"><br><br>
            <label for="mass">Mass: </label>
            <input placeholder= "<?php echo $data['mass']; ?>" name="mass" type="number" step="0.01" min="0" style="float:right"><br><br>
            <label for="pipe_material">Pipe <br>Material: </label>
            <input placeholder= "<?php echo $data['pipe_material']; ?>" name="pipe_material" type="text" style="float:right"><br><br>
            <label for="pipe_wall_thickness">Pipe Wall <br>Thickness: </label>
            <input placeholder= "<?php echo $data['pipe_wall_thickness']; ?>" name="pipe_wall_thickness" type="number" step="0.01" min="0" style="float:right"><br><br>
            <label for="foam_type">Foam Type: </label>
            <input placeholder= "<?php echo $data['foam_type']; ?>" name="foam_type" type="text" style="float:right"><br><br>
            <label for="wings_ply">Ply of <br>Wings: </label>
            <input placeholder= "<?php echo $data['wings_ply']; ?>" name="wings_ply" type="number" step="1" min="0" style="float:right"><br><br>
            <label for="airex_stack">Stack of <br>Airex: </label>
            <input placeholder= "<?php echo $data['airex_stack']; ?>" name="airex_stack" type="number" step="1" min="0" style="float:right"><br><br>
          </div>
          <h2>Notes</h2>
          <?php echo nl2br($notes); ?>
          <br>
          <div style="width:400px;">
            <!--Notes: <input name="notes" type="text" style="float:right" size="20"><br><br>-->
            <label for="notes">Additional Notes: </label>
            <textarea cols="40" rows="5" name="notes"></textarea>
            <br>
          </div>

          <h2>Pictures</h2>
          <div style="width:475px;">
            <label for="pic">Picture File: </label>
            <input name="pic" type="file" style="float:right">
            <br><br>
          </div>
          <div style="width:400px;">
            <label for="picnotes">Picture Notes: </label>
            <input name="picnotes" type="text" style="float:right"><br><br>
          </div>

          <h2>Misc Files</h2>
          <div style="width:475px;">
            <label for="files[]">Misc File(s): </label>
            <input name="files[]" id="files" type="file" multiple="multiple"  style="float:right"><br><br>
          </div>
          <?php
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
            $time = date('m-d-Y H:i:s');
            echo "<input type='hidden' name='lastEdit' value='".$time."'>";
          ?>
          <br>
          <input class="button" type="submit" name="submit" value="Submit">
        </form>
      </main>
    </div>
  </body>
</html>
