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
    <title> Edit <?php echo $name; ?></title>
  </head>
  <body>
    <h1>Edit: <?php echo $name; ?></h1>
    <form action="heaterEditProc.php" method="post"
    enctype="multipart/form-data">
      <div style="width:300px;">
        <h2>Notes</h2>
        <?php echo nl2br($notes); ?>
        <br>
        <div style="width=225px">
          Additional Notes: <textarea cols="40" rows="5"
          name="notes"></textarea>
          <br><br>
        </div>
      </div>
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" name="submit" value="Submit">
    </form>
    <input type=button onClick="location.href='part_list.php'" value='Part List'>
    <br><br>
    <input type=button onClick="location.href='index.php'" value='Index'>
  </body>
</html>
