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
    <title> Edit <?php echo $name; ?></title>
  </head>
  <body>
    <h1>Edit: <?php echo $name; ?></h1>
    <form action="mockModuleSensorEditProc.php" method="post" enctype="multipart/form-data">
      <div style="width:300px;">
    	  Thickness: <input placeholder="<?php echo $si_thickness; ?>" name ="curThickness" type="number" step="0.1" style="float:right"><br><br>
	      Adhesive: <input placeholder="<?php echo $adhesive; ?>" name ="curAdhesive" type="text" style="float:right"><br><br>
	       Geometry: <input placeholder="<?php echo $geometry; ?>" name = "curGeometry" type="text" style="float:right"><br><br>	
        <h2>Notes</h2>
        <?php echo nl2br($notes); ?>
        <br>
        <div style="width:225px">
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
