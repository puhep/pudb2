<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Submit New Test</title>
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
        <h1>Submit New Test</h1>
        <?php
          require_once("database.php");
          $db = new Database();
        ?>
        <form action="newtest_proc.php" method="post" enctype="multipart/form-data">
          <div style="width:300px;">
            <label for="name">Test Name: </label>
            <input name="name" type="text" style="float:right" required><br><br>
            <label for="support_structure">Support Structure: </label>
            <select name="support_structure" required>
              <?php
                $sql = "SELECT name,id FROM support_structure ORDER BY name ASC";
                $db->query($sql);
                echo "<option value=\"\">Select a Support Structure</option>\n";
                while ($db->nextRecord()) {
                  $id = $db->Record['id'];
                  $name = $db->Record['name'];
                  echo "<option value=\"$id\">".$name."</option>\n";
                }
              ?>
            </select>
            <br><br>
            Import Geometry: <select name="oldtest">
              <?php
                $sql = "SELECT name,id FROM test ORDER BY name ASC";
                $db->query($sql);
                echo "<option value=\"\">Select a Test</option>\n";
                while ($db->nextRecord()) {
                  $id = $db->Record['id'];
                  $name = $db->Record['name'];
                  echo "<option value=\"$id\">".$name."</option>\n";
                }
              ?>
            </select>
            <br><br>
            <div style="width:475px">
              <label for="files[]">Upload Temperature-to-Time Excel File</label>
              <input name="files[]" id="files" type="file" style="float:right">
            </div>
            <br><br>
          </div>
          <input class="button" type="submit" name="submit" value="Submit">
        </form>
      </main>
    </div>
  </body>
</html>
