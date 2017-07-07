<!DOCTYPE html>
<?php
  require_once("functions.php");
  require_once("database.php");
  $db = new Database();
  $id = $_GET['id'];
  $data = $db->db_query("SELECT * FROM test where id=$id");
  $data       = $data[0];
  $testType   = $data['testType'];
  $miscData   = testData2($id,$db);
  $sensorData = sensorTestData($id,$db);
  $heaterData = heaterTestData($id,$db);
  $moduleData = moduleTestData($id,$db);
  $name=$miscData['testName'];
  $ssName=$miscData['ssName'];
  $ssID=$miscData['ssID'];
  $coolantTemp=$miscData['coolantTemp'];
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"test\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
  $showDataAnalysis = false;
  $filePath = "../phase_2/files/test/$id/dataAnalysis.csv";
  // if (file_exists($filePath)) {
  //   echo "hello"
  // }
  //   $showDataAnalysis = false;
  //   echo "world";
  // } else {
  //   $file = fopen($filePath);
  //   $i = 0;
  //   while (!feof($file)) {
  //     $temp = fgetcsv($file);
  //     $i++;
  //   }
  //   echo "<h2>Hello</h2>";
  // }
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Test <?php echo $name ?> Summary</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.gif"width="100" height="100" alt="CMS Logo">
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
        <h1>Test <?php echo $name; ?> Summary</h1>
        <span>Last Edited:
          <?php
            if ($data['lastEdit'] != "") {
              echo $data['lastEdit'];
            } else {
              echo "Not yet recorded";
            }
          ?>
        </span>
        <form method="get" action="test_edit.php">
          <?php
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
    	    ?>
          <input class="button" type="submit" value="Edit Test">
        </form>

        <?php
          echo "<p>Support Structure: <a href='ss_summary.php?id=".$ssID."'>$ssName</a></p>";
          echo "<p>Coolant Temperature: ".$coolantTemp."&deg;C</p>";
          echo "<h2>Object Data</h2>";
          show_sensors($sensorData);
          echo "<br>";
          show_sensors($heaterData,0,"heater");
          echo "<br>";
          show_sensors($moduleData,0,"module");
          echo "<br>";
          echo "<h2>Geometry</h2>";
          if ($testType == "" || $testType == "Wing") {
            echo "<a href=\"./graphs/test_geometry.php?id=$id\" target=\"_blank\"><img src=\"./graphs/test_geometry.php?id=$id\" width=\"300\" height=\"300\"></a>";
          } else if ($testType == "LinGrad") {
            echo "<a href=\"./graphs/linearGradPlot.php?id=$id\" target=\"_blank\"><img src=\"./graphs/linearGradPlot.php?id=$id\" width=\"300\" height=\"200\"></a>";
          } else if ($testType == "AlumCase") {
            echo "<a href=\"./graphs/aluminumCasingPlot.php?id=$id\" target=\"_blank\"><img src=\"./graphs/aluminumCasingPlot.php?id=$id\" width=\"300\" height=\"200\"></a>";
          }
          echo "<h2>Notes</h2>";
          if($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
          echo "<h2>Pictures</h2>";
          show_pictures("test",$id);
          if (file_exists("../phase_2/files/test/$id/tempVsTime.csv")){
            echo "<h2>Graphs</h2>"
                ."<h4>Temperature over Time</h4>";
            echo "<a href=\"./graphs/tempVsTime.php?id=$id\" target=\"blank\"><img src=\"./graphs/tempVsTime.php?id=$id\" width=\"300\" height=\"300\" ></a>";
            $filePath = "../phase_2/files/test/$id/dataAnalysis.csv";
            $file = fopen($filePath, "r");
            $line1 = fgetcsv($file);
            $line2 = fgetcsv($file);
            if ($line2 != null) {
              echo "<h4><a href=\"./graphs/avgTemp.php?id=$id\" target=\"_blank\">Averaged Temperatures</a></h4>";
              echo "<div>
                      <object type=text/html data=\"./graphs/avgTemp.php?id=$id\" width=\"800px\" height=\"470px\" style=\"overflow:auto;\">
                      </object>
                    </div>";
            }
          }
          echo "<h2>Misc Files</h2>";
          show_files("test",$id);
        ?>
      </main>
    </div>
  </body>
</html>
