<!DOCTYPE html>
<?php
  require_once("database.php");
  $id=$_GET['id'];
  $db=new Database();
  $sql="SELECT * FROM support_structure where id=$id";
  $db->query($sql);
  $db->singleRecord();
  $data=$db->Record;
  $name=$data['name'];

  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"support_structure\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];

  $sql = "SELECT name,id FROM test where assoc_ss=".$id;
  $db->query($sql);
  $i=0;
  while ($db->nextRecord()) {
    $tests[$i]=$db->Record;
    $i++;
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
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
        <h1><?php echo $name; ?> Summary</h1>
        <span>Last Edited:
          <?php
            if ($data['lastEdit'] != "") {
              echo $data['lastEdit'];
            } else {
              echo "Not yet recorded";
            }
          ?>
        </span>
      <?php
        // table that shows info about the sheet
        echo
          "<table border=1 cellpadding=5>".
            "<tr><td>Object Type</td><td>Support Structure</td></tr>".
            "<tr><td>Name</td><td>".$name."</td></tr>".
            "<tr><td>Mass</td><td>".$data['mass']."</td></tr>".
            "<tr><td>Pipe Material</td><td>".$data['pipe_material']."</td></tr>".
            "<tr><td>Pipe Wall Thickness</td><td>".$data['pipe_wall_thickness']."</td></tr>".
            "<tr><td>Foam Type</td><td>".$data['foam_type']."</td></tr>".
            "<tr><td>Ply of Wings</td><td>".$data['wings_ply']."</td></tr>".
            "<tr><td>Stack of Airex</td><td>".$data['airex_stack']."</td></tr>".
          "</table><br>";
      ?>
      <form method="get" action="ss_edit.php">
        <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
        <input class="button" type="submit" value="Edit Part">
      </form>
      <?php
        echo "<h2>Tests</h2>";
          if (isset($tests)) {
            echo "<ul>";
            foreach ($tests as $row) {
              echo "<li><a href='test.php?id=".$row['id']."' >".$row['name']."</a></li>";
              #echo $row['name']."<br>";
            }
            echo "</ul>";
          } else {
            echo "No tests found";
          }
          echo "<h2>Notes</h2>";
          if ($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
          echo "<h2>Pictures</h2>";
          show_pictures("support_structure",$id);
          echo "<h2>Misc Files</h2>";
          show_files("support_structure",$id);
        ?>
        <br>
      </main>
    </div>
  </body>
</html>
