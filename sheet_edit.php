<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM sheet where id=$id";
  $data=db_query($sql,$db);
  $data=$data[0];
  $name=$data['name'];
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Edit <?php echo $name; ?></title>
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
      <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
      <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
      <a href="contact.php">Contact/Issues</a>
    </nav>
    <h1>Edit <?php echo $name; ?></h1>
    <form action="sheet_edit_proc.php" method="post" enctype="multipart/form-data">
      <div style="width:350px;">
        <label for="name">Name: </label>
        <input placeholder= "<?php echo $data['name']; ?>" name="name" type="text" style="float:right"><br><br>
        <label for="location">Location: </label>
        <input placeholder= "<?php echo $data['location']; ?>" name="location" type="text" style="float:right"><br><br>
        <label for="ply">Ply: </label>
        <input placeholder= "<?php echo $data['ply']; ?>" name="ply" type="number" step="1" style="float:right"><br><br>
        <label for="mass_nb">Mass before: </label>
        <input placeholder= "<?php echo $data['mass_nb']; ?>" name="mass_nb" type="number" step="0.01" style="float:right"><br><br>
        <label for="mass_after">Mass after: </label>
        <input placeholder= "<?php echo $data['mass_after']; ?>" name="mass_after" type="number" step="0.01" style="float:right"><br><br>
        <label for="num_wax_coats">Number of wax coats: </label>
        <input placeholder= "<?php echo $data['num_wax_coats']; ?>" name="num_wax_coats" type="number" step="1" style="float:right"><br><br>
        <label for="curing_stackup">Curing stackup: </label>
        <input placeholder= "<?php echo $data['curing_stackup']; ?>" name="curing_stackup" type="text" style="float:right"><br><br>
        <label for="user_cut">Cut by: </label>
        <input placeholder= "<?php echo $data['user_cut']; ?>" name="user_cut" type="text" style="float:right"><br><br>
        <label for="user_bagged">Bagged by: </label>
        <input placeholder= "<?php echo $data['user_bagged']; ?>" name="user_bagged" type="text" style="float:right"><br><br>
        <label for="user_ramp">Ramped up by: </label>
        <input placeholder= "<?php echo $data['user_ramp']; ?>" name="user_ramp" type="text" style="float:right"><br><br>
        <label for="user_check1">Checked (1) by: </label>
        <input placeholder= "<?php echo $data['user_check1']; ?>" name="user_check1" type="text" style="float:right"><br><br>
        <label for="user_check2">Checked (2) by: </label>
        <input placeholder= "<?php echo $data['user_check2']; ?>" name="user_check2" type="text" style="float:right"><br><br>
        <label for="user_check3">Checked (3) by: </label>
        <input placeholder= "<?php echo $data['user_check3']; ?>" name="user_check3" type="text" style="float:right"><br><br>
        <label for="user_remove">Removed by: </label>
        <input placeholder= "<?php echo $data['user_remove']; ?>" name="user_remove" type="text" style="float:right"><br><br>
        <label for="user_measure">Measured by: </label>
        <input placeholder= "<?php echo $data['user_measure']; ?>" name="user_measure" type="text" style="float:right"><br><br>
        <label for="thickness1">Edge Thickness 1: </label>
        <input placeholder= "<?php echo $data['thickness1']; ?>" name="thickness1" type="number" step="0.01" style="float:right"><br><br>
        <label for="thickness2">Edge Thickness 2: </label>
        <input placeholder= "<?php echo $data['thickness2']; ?>" name="thickness2" type="number"step="0.01" style="float:right"><br><br>
        <label for="thickness3">Edge Thickness 3: </label>
        <input placeholder= "<?php echo $data['thickness3']; ?>" name="thickness3" type="number" step="0.01" style="float:right"><br><br>
        <label for="thickness4">Edge Thickness 4: </label>
        <input placeholder= "<?php echo $data['thickness4']; ?>" name="thickness4" type="number" step="0.01" style="float:right"><br><br>
      </div>
      <h2>Notes</h2>
      <?php echo nl2br($notes); ?>
      <br>
      <div style="width:225px;">
          <label for="notes">Additional Notes: </label>
          <textarea cols="40" rows="5" name="notes"></textarea><br>
      </div>
      <h2>Pictures</h2>
      <div style="width:340px;">
        <label for="pic">Picture File: </label>
        <input name="pic" type="file" style="float:right"><br><br>
      </div>
      <div style="width:275px;">
        <label for="picnotes">Picture Notes: </label>
        <input name="picnotes" type="text" style="float:right"><br><br>
      </div>
      <h2>Misc Files</h2>
      <div style="width:340px;">
        <label for="files[]">Misc File(s): </label>
        <input name="files[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
      </div>
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" name="submit" value="Submit">
    </form>
    <br><br>
    <form method="get" action="sheet.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Part Summary">
    </form>
  </body>
</html>
