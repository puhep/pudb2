<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title>Submit New Misc Part</title>
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
        <h1>Submit New Misc Part</h1>
        <form action="newMiscPartProc.php" method="post" enctype="multipart/form-data">
          <div style="width:450px">
            <label for="name">Name</label>
            <input type="text" name="name" required="required" style="float:right"><br><br>
            <label for="currentLocation">Current Location</label>
            <input type="text" name="currentLocation" style="float:right"><br><br>
            <label for="prodLocation">Produced Location</label>
            <input type="text" name="prodLocation" style="float:right"><br><br>
          </div>
          <h2>Notes</h2>
          <div style="width:400px">
            <label for="notes">Additional Notes:</label>
            <textarea name="notes" cols="40" rows="5"></textarea><br>
          </div>
          <h2>Pictures</h2>
          <div style="width:550px">
            <label for="pic">Picture File:</label>
            <input name="pic" type="file" style="float:right"><br><br>
          </div>
          <div style="width:475px;">
            <label for="picnotes">Picture Notes:</label>
            <input name="picnotes" type="text" style="float:right"><br><br>
          </div>
          <h2>Misc Files</h2>
          <div style="width:550px;">
            <label for="files[]">Misc File(s):</label>
            <input name="files[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
          </div>
          <?php
            $time = date('m-d-y H:i:s');
            echo "<input type='hidden' name='lastEdit' value='".$time."'>";
          ?>
          <input class="button" type="submit" name="submit" value="Submit">
        </form>
      </main>
    </div>
  </body>
</html>
