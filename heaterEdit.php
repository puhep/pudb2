<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db=new Database();
  $sql="SELECT * FROM heater where id=$id";
  $data=db_query($sql, $db);
  $data=$data[0];
  $name=$data['name'];

  $sql="SELECT notetext FROM notes WHERE part_id=$id AND part_type=\"heater\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>

<html>
  <head>
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
    <h1>Edit: <?php echo $name; ?></h1>
    <form action="heaterEditProc.php" method="post"
    enctype="multipart/form-data">
      <div style="width:300px;">
        <h2>Notes</h2>
        <?php echo nl2br($notes); ?>
        <br>
        <div style="width=225px">
          <label for="notes">Additional Notes: </label>
          <textarea cols="40" rows="5" name="notes"></textarea>
          <br><br>
        </div>
      </div>
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" name="submit" value="Submit">
    </form>
    <input type=button onClick="location.href='part_list.php'" value='Part List'>
  </body>
</html>
