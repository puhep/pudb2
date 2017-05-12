<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $data=db_query("SELECT * FROM heater where id=$id",$db);
  $data=$data[0];
  $name=$data['name'];     

  $sql="SELECT notetext FROM notes WHERE part_id=$id AND part_type=\"heater\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <h1><?php echo $name; ?> Summary</h1>
    <p>Object Type: Heater</p><p>Name: <?php echo $name; ?></p>
    <h2>Notes</h2>
    <?php
      if ($notes!="") {
        echo "<p>".nl2br($notes)."</p>";
      } else {
        echo "No notes found";
      }
    ?>
    <br><br>
    <form method="get" action="heaterEdit.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Edit Part">
    </form>
    <input type=button onClick="location.href='part_list.php'" value='Part List'>
    <br><br>
    <input type=button onClick="location.href='index.php'" value='Index'>
  </body>
</html>
