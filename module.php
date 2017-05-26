<!DOCTYPE html>
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
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <h2>Misc Data</h2>
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
          echo
            "<table border=1 cellpadding=5>".
              "<tr><td>Object Type</td><td>Mock Module</td></tr>".
              "<tr><td>Name</td><td>$name</td></tr>".
              "<tr><td>Si Thickness</td><td>$si_thickness</td></tr>".
              "<tr><td>Adhesive</td><td>$adhesive</td></tr>".
              "<tr><td>Geometry</td><td>$geometry</td></tr>".
            "</table><br>";
        ?>
        <form method="get" action="module_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Edit Part">
        </form>
        <h2>Notes</h2>
        <?php
          if($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
        ?>
        <br>
      </main>
    </div>
  </body>
</html>
