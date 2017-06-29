<!--
 @ToDo: Check issue #22 on GitHub
-->

<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $data=$db->db_query("SELECT * FROM sheet where id=$id");
  $data=$data[0];
  $name=$data['name'];
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
  if($data['thickness1'] != "") {
    $thicknesses = $data['thickness1']." mm, ".$data['thickness2']." mm, ".$data['thickness3']." mm, ".$data['thickness4']." mm";
  } else {
    $thicknesses = "";
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
          echo "<table border=1 cellpadding=5>";
          echo "<tr><td>Object Type</td><td>Sheet</td></tr>";
          echo "<tr><td>Name</td><td>".$data['name']."</td></tr>";
          echo "<tr><td>Location</td><td>".$data['location']."</td></tr>";
          echo "<tr><td>Date Cut</td><td>".$data['dateCut']."</td></tr>";
          echo "<tr><td>Ply</td><td>".$data['ply']."</td></tr>";
          echo "<tr><td>Mass before Backing</td><td>".$data['mass_nb']." g</td></tr>";
          echo "<tr><td>Cut By</td><td>".$data['user_cut']."</td></tr>";
          echo "<tr><td>Date put into Oven </td><td>".$data['dateOven']."</td></tr>";
          echo "<tr><td>Bagged/Oven Turned on By </td><td>".$data['user_bagged']."</td></tr>";
          echo "<tr><td>Number of Wax Coats </td><td>".$data['num_wax_coats']."</td></tr>";
          echo "<tr><td>Number of Times Bag was used Previously </td><td>".$data['bagUseTimes']."</td></tr>";
          echo "<tr><td>Vacuum Bag Checked for Leaks</td><td>".$data['checkedLeaks']."</td></tr>";
          echo "<tr><td>Curing stackup </td><td>".$data['curing_stackup']."</td></tr>";
          echo "<tr><td>Time of Oven Start </td><td>".$data['ovenStart']."</td></tr>";
          echo "<tr><td>Time Reached 107 </td><td>".$data['ovenReach107']."</td></td>";
          echo "<tr><td>Checked (1) By </td><td>".$data['user_check1']."</td></tr>";
          echo "<tr><td>Time Began Ramping</td><td>".$data['timeRamp']."</td></tr>";
          echo "<tr><td>Ramped up By </td><td>".$data['user_ramp']."</td></tr>";
          echo "<tr><td>Time Reached 177</td><td>".$data['ovenReach177']."</td></tr>";
          echo "<tr><td>Checked (2) By </td><td>".$data['user_check2']."</td></tr>";
          echo "<tr><td>Time Shut Off </td><td>".$data['timeOvenOff']."</td></tr>";
          echo "<tr><td>Checked (3) By </td><td>".$data['user_check3']."</td></tr>";
          echo "<tr><td>Time Removed </td><td>".$data['timeRemoved']."</td></tr>";
          echo "<tr><td>Removed By </td><td>".$data['user_remove']."</td></tr>";
          echo "<tr><td>Length Outside </td><td>".$data['lengthOutside']." inches</td></tr>";
          echo "<tr><td>Length Inside </td><td>".$data['lengthInside']." inches</td></tr>";
          echo "<tr><td>Height Outside </td><td>".$data['heightOutside']." inches</td></tr>";
          echo "<tr><td>Height Inside </td><td>".$data['heightInside']." inches</td></tr>";
          echo "<tr><td>Mass after </td><td>".$data['mass_after']." g</td></tr>";
          echo "<tr><td>Average Thickness</td><td>".$data['avgThickness']." mm</td></tr>";
          echo "<tr><td>Minimum Thickness</td><td>".$data['minThickness']." mm</td></tr>";
          echo "<tr><td>Maximum Thickness</td><td>".$data['maxThickness']." mm</td></tr>";
          echo "<tr><td>Edge Thicknesses </td><td>".$thicknesses."</td></tr>";
          echo "<tr><td>Bow </td><td>".$data['bow']." mm</td></tr>";
          echo "<tr><td>Measured By </td><td>".$data['user_measure']."</td></tr>";
          echo "</table><br>";
        ?>
        <form method="get" action="sheet_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Edit Part">
        </form>
        <?php
          echo "<h2>Notes</h2>";
          if ($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
          echo "<h2>Pictures</h2>";
          show_pictures("sheet",$id);
          if (file_exists("../phase_2/files/sheet/$id/ThicknessContour.csv")) {
            echo "<h2>Graphs</h2>"
                ."<h4><a href=\"./php/sheetContour.php?id=$id\" target=\"_blank\">Sheet Thickness Contour</a></h4>";
            echo "<div>
                    <object type=text/html data=\"http://www.physics.purdue.edu/cmsfpix////phase_2/php/sheetContour.php?id=$id\" width=\"800px\" height=\"470px\" style=\"overflow:auto;\">
                    </object>
                  </div>";
          }
          echo "<h2>Misc Files</h2>";
          show_files("sheet",$id);
        ?>
        <br>
      </main>
    </div>
  </body>
</html>
