<!--
This page is, as the name suggests, a list of parts. All physical parts involved with the project should
be listed here, along with links to their respective pages.
Currently, we have support structures, thermal sensors, heaters, mock modules, and sheets.
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Part List</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.png" width="100" height="100" alt="CMS Logo">
        </a>
      </header>
      <nav>
        <a class="active" href="part_list.php">Part List</a>
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
        <h1>Part List</h1>
        <?php
          require_once("database.php");
          $db = new Database();

          ### query the database for all relevant information regarding the part types
          $ss        = $db->db_query("SELECT id, name FROM support_structure");
          $ts        = $db->db_query("SELECT id, name FROM thermal_sensor");
          $heaters   = $db->db_query("SELECT id, name FROM heater");
          $modules   = $db->db_query("SELECT id, name FROM mock_module");
          $sheets    = $db->db_query("SELECT id, name FROM sheet");
          $miscParts = $db->db_query("SELECT id, name FROM miscPart");

          ### display the part links in nested tables. The outer table is borderless, so it's not visible.
          echo "<table border=0 cellpadding=10 val=aligntop>";
          echo "<tr valign=top><td>";
          echo "<table border=1>";
          echo "<tr><th>Support Structures</th></tr>";
          foreach ($ss as $structure) {
            echo "<tr><td>";
            echo "<a href=\"ss_summary.php?id=$structure[0]\">$structure[1]</a>";
            echo "</td></tr>";
          }
          echo "</table><br>";
          #echo "</td><td>";
          echo "</td><td>";
          echo "<table border=1>";
          echo "<tr><th>Thermal Sensors</th></tr>";
          foreach ($ts as $sensor) {
  	         echo "<tr><td>";
             echo "<a href=\"thermal_sensor.php?id=$sensor[0]\">$sensor[1]</a>";
             echo "</td></tr>";
           }
          echo "</table><br>";
          echo "</td>";
          echo "<td>";
          echo "<table border=1>";
          echo "<th>Heaters</th>";
          foreach ($heaters as $heater) {
            echo "<tr><td>";
            echo "<a href=\"heater.php?id=$heater[0]\">$heater[1]</a>";
            echo "</td></tr>";
          }
          echo "</table><br>";
          echo "</td>";
          echo "<td>";
          echo "<table border=1>";
          echo "<th>Mock Modules</th>";
          foreach ($modules as $module) {
            echo "<tr><td>";
            echo "<a href=\"module.php?id=$module[0]\">$module[1]</a>";
            echo "</td></tr>";
          }
          echo "</table><br>";
          echo "</td>";
          echo "<td>";
          echo "<table border=1>";
          echo "<th><a href=\"sheetSummary.php\">Sheets</a></th>";
          foreach ($sheets as $sheet) {
            echo "<tr><td>";
            echo "<a href=\"sheet.php?id=$sheet[0]\">$sheet[1]</a>";
            echo "</td></tr>";
          }
          echo "<tr><td class=\"largeCell\"><input class=\"button\" type=button onClick=\"location.href='newsheet.php'\" value='Add Sheet'></td></tr>";
          echo "</table><br>";
          echo "</td>";

          echo "<td>";
          echo "<table border=1>";
          echo "<th>Misc Parts</th>";
          foreach ($miscParts as $miscPart) {
            echo "<tr><td>";
            echo "<a href=\"miscPart.php?id=$miscPart[0]\">$miscPart[1]</a>";
            echo "</td></tr>";
          }
          echo "<tr><td class=\"largeCell\"><input class=\"button\" type=button onClick=\"location.href='newMiscPart.php'\" value='Add Misc Part'></td></tr>";
          echo "</table><br>";
          echo "</td>";
          echo "</tr>";
          echo "</table>";
        ?>
      </main>
    </div>
  </body>
</html>
