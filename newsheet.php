<!--
  This is a fairly simple page that simply asks for a sheet name.
  On submission. the query is processed by the newsheet_proc page
  The user is then redirected to the sheet editing page for the new sheet
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Submit New Sheet</title>
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
      <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
      <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
      <a href="contact.php">Contact/Issues</a>
    </nav>
    <h1>Submit New Sheet</h1>
    <form action="newsheet_proc.php" method="post" enctype="multipart/form-data">
      <div style="width:300px;">
        <label for="name">Sheet Name: </label>
        <input name="name" type="text" style="float:right" required>
        <br><br>
      </div>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
