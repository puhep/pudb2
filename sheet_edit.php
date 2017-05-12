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
    <title>Edit <?php echo $name; ?></title>
    <body>
      <h1>Edit <?php echo $name; ?></h1>
      <form action="sheet_edit_proc.php" method="post" enctype="multipart/form-data">
        <div style="width:300px;">
          Name: <input placeholder= "<?php echo $data['name']; ?>" name="name" type="text" style="float:right"><br><br>
          Location: <input placeholder= "<?php echo $data['location']; ?>" name="location" type="text" style="float:right"><br><br>
          Ply: <input placeholder= "<?php echo $data['ply']; ?>" name="ply" type="number" step="1" style="float:right"><br><br>
          Mass before: <input placeholder= "<?php echo $data['mass_nb']; ?>" name="mass_nb" type="number" step="0.01" style="float:right"><br><br>
          Mass after: <input placeholder= "<?php echo $data['mass_after']; ?>" name="mass_after" type="number" step="0.01" style="float:right"><br><br>
          # of wax coats: <input placeholder= "<?php echo $data['num_wax_coats']; ?>" name="num_wax_coats" type="number" step="1" style="float:right"><br><br>
          Curing stackup: <input placeholder= "<?php echo $data['curing_stackup']; ?>" name="curing_stackup" type="text" style="float:right"><br><br>
          Cut by: <input placeholder= "<?php echo $data['user_cut']; ?>" name="user_cut" type="text" style="float:right"><br><br>
          Bagged by: <input placeholder= "<?php echo $data['user_bagged']; ?>" name="user_bagged" type="text" style="float:right"><br><br>
          Ramped up by: <input placeholder= "<?php echo $data['user_ramp']; ?>" name="user_ramp" type="text" style="float:right"><br><br>
          Checked (1) by: <input placeholder= "<?php echo $data['user_check1']; ?>" name="user_check1" type="text" style="float:right"><br><br>
          Checked (2) by: <input placeholder= "<?php echo $data['user_check2']; ?>" name="user_check2" type="text" style="float:right"><br><br>
          Checked (3) by: <input placeholder= "<?php echo $data['user_check3']; ?>" name="user_check3" type="text" style="float:right"><br><br>
          Removed by: <input placeholder= "<?php echo $data['user_remove']; ?>" name="user_remove" type="text" style="float:right"><br><br>
          Measured by: <input placeholder= "<?php echo $data['user_measure']; ?>" name="user_measure" type="text" style="float:right"><br><br>
          Edge Thickness 1: <input placeholder= "<?php echo $data['thickness1']; ?>" name="thickness1" type="number" step="0.01" style="float:right"><br><br>
          Edge Thickness 2: <input placeholder= "<?php echo $data['thickness2']; ?>" name="thickness2" type="number"step="0.01" style="float:right"><br><br>
          Edge Thickness 3: <input placeholder= "<?php echo $data['thickness3']; ?>" name="thickness3" type="number" step="0.01" style="float:right"><br><br>
          Edge Thickness 4: <input placeholder= "<?php echo $data['thickness4']; ?>" name="thickness4" type="number" step="0.01" style="float:right"><br><br>
        </div>
        <h2>Notes</h2>
        <?php echo nl2br($notes); ?>
        <br>
        <div style="width:225px;">
        <!--Notes: <input name="notes" type="text" style="float:right" size="20"><br><br>-->
        Additional Notes: <textarea cols="40" rows="5" name="notes"></textarea><br>
      </div>
      <h2>Pictures</h2>
      <div style="width:340px;">
        Picture File: <input name="pic" type="file" style="float:right"><br><br>
      </div>
      <div style="width:275px;">
        Picture Notes: <input name="picnotes" type="text" style="float:right"><br><br>
      </div>
      <h2>Misc Files</h2>
      <div style="width:340px;">
        Misc File(s): <input name="file[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
      </div>
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" name="submit" value="Submit">  
    </form>   
    <br><br>
    <form method="get" action="sheet.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Part Summary">
   </form>
   <input type=button onClick="location.href='part_list.php'" value='Part List'>
   <br><br>
   <input type=button onClick="location.href='index.php'" value='Index'>
 </body>
</html>
