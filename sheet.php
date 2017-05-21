<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $data=db_query("SELECT * FROM sheet where id=$id",$db);
  $data=$data[0];
  $name=$data['name'];
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
  if($data['thickness1'] != "") {
    $thicknesses = $data['thickness1'].", ".$data['thickness2'].", ".$data['thickness3'].", ".$data['thickness4'];
  } else {
    $thicknesses = "";
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <div id="wrapper"
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
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h1><?php echo $name; ?> Summary</h1>
        <?php
          echo "<table border=1 cellpadding=5>";
          echo "<tr><td>Object Type </td><td>Sheet</td></tr>";
          echo "<tr><td>Name </td><td>".$data['name']."</td></tr>";
          echo "<tr><td>Location </td><td>".$data['location']."</td></tr>";
          echo "<tr><td>Ply </td><td>".$data['ply']."</td></tr>";
          echo "<tr><td>Mass before backing (g) </td><td>".$data['mass_nb']."</td></tr>";
          echo "<tr><td>Cut by </td><td>".$data['user_cut']."</td></tr>";
          echo "<tr><td>Bagged/oven turned on by </td><td>".$data['user_bagged']."</td></tr>";
          echo "<tr><td>Number of wax coats </td><td>".$data['num_wax_coats']."</td></tr>";
          echo "<tr><td>Curing stackup </td><td>".$data['curing_stackup']."</td></tr>";
          echo "<tr><td>Checked (1) by </td><td>".$data['user_check1']."</td></tr>";
          echo "<tr><td>Ramped up by </td><td>".$data['user_ramp']."</td></tr>";
          echo "<tr><td>Checked (2) by </td><td>".$data['user_check2']."</td></tr>";
          echo "<tr><td>Checked (3) by </td><td>".$data['user_check3']."</td></tr>";
          echo "<tr><td>Removed by </td><td>".$data['user_remove']."</td></tr>";
          echo "<tr><td>Mass after (g) </td><td>".$data['mass_after']."</td></tr>";
          echo "<tr><td>Measured by </td><td>".$data['user_measure']."</td></tr>";
          echo "<tr><td>Edge Thicknesses (um): </td><td>".$thicknesses."</td></tr>";
          echo "</table>";
          echo "<h2>Notes</h2>";
          if ($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
          echo "<h2>Pictures</h2>";
          show_pictures("sheet",$id);
          echo "<h2>Misc Files</h2>";
          show_files("sheet",$id);
        ?>
        <br><br>
        <form method="get" action="sheet_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Edit Part">
        </form>
      </main>
    </div>
  </body>
</html>
