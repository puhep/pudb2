<!--
  This page lists all tests, indexed by their associated support structure.
  Support Structure 1 is not a physical structure used by the group
  Rather, it is my/our testing ground
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Test List</title>
  </head>
  <body>
    <a href="index.php">
      <div class="header">
        <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
        <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
      </div>
    </a>
    <nav>
      <a href="part_list.php">Part List</a>
      <br>
      <a class="active" href="test_list.php">Test List</a>
      <br>
      <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
      <br>
      <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
      <br>
      <a href="contact.php">Contact/Issues</a>
    </nav>
    <div class="content">
      <h1>Test List</h1>
      <?php
        require_once("database.php");
        $db = new Database();
        $sql = "SELECT id,name FROM support_structure";
        $db->query($sql);
        $i=0;
        $out=array();
        while ($db->nextRecord()) {
          $out[$i] = $db->Record;
          $i++;
        }
        echo "<table border=1 cellpadding=5>";
        echo "<tr><th>Support Structures</th>";
        echo "<th>Tests</tr>";
        foreach ($out as $structure) {
          echo "<tr>";
          echo "<td>";
          echo "<a href=\"ss_summary.php?id=$structure[0]\">$structure[1]</a>";
          echo "</td>";
          echo "<td>";
          $sql="SELECT name,id FROM test WHERE assoc_ss=".$structure[0];
          $db->query($sql);
          while($db->nextRecord()) {
            $name=$db->Record['name'];
            $id=$db->Record['id'];
            echo "<a href=\"test.php?id=".$id."\">$name</a><br>";
          }
          echo "</td>";
          echo "</tr>";
        }
        echo "</table><br>";
      ?>
      <br><br>
      <input class="button" type=button onClick="location.href='newtest.php'" value='New Test'>
    </div>
  </body>
</html>
