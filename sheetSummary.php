<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Sheet Summary</title>
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
        <h2>Sheet Thickness Vs Date of Curing</h2>
        <h4>Both 3 and 8 Ply</h4>
        <div>
          <object type=text/html data="./graphs/sheetThicknessVsDate.php" width="800px" height="470px" style="overflow:auto;">
          </object>
        </div>
        <h4>3 Ply Sheets</h4>
        <div>
          <object type=text/html data="./graphs/sheetThicknessVsDate3.php" width="800px" height="470px" style="overflow:auto;">
          </object>
        </div>
        <h4>8 Ply Sheets</h4>
        <div>
          <object type=text/html data="./graphs/sheetThicknessVsDate8.php" width="800px" height="470px" style="overflow:auto;">
          </object>
        </div>
      </main>
    </div>
  </body>
</html>
