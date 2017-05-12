<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $data=db_query("SELECT * FROM mock_module where id=$id",$db);
  $data=$data[0];
  #print_r($data);
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
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <h1><?php echo $name; ?> Summary</h1>
    <p>Object Type: Mock Module</p> 
    <p>Name: <?php echo $name; ?></p>
    <p>Thickness: <?php echo $si_thickness; ?></p>
    <p>Adhesive: <?php echo $adhesive; ?></p>
    <p>Geometry: <?php echo $geometry; ?></p>
    <h2>Notes</h2>
    <?php
      if($notes!="") {
        echo "<p>".nl2br($notes)."</p>";
      } else {
        echo "No notes found";
      }
    ?>
    <br><br>
    <form method="get" action="module_edit.php">
      <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
      <input type="submit" value="Edit Part">
    </form>
    <input type=button onClick="location.href='part_list.php'" value='Part List'>
    <br><br>
    <input type=button onClick="location.href='index.php'" value='Index'>
  </body>
</html>
