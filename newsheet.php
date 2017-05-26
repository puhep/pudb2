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
        <h1>Submit New Sheet</h1>
        <form action="newsheet_proc.php" method="post" enctype="multipart/form-data">
          <div style="width:450px;">
            <label for="name">Name: </label>
            <input name="name" type="text" required="required" style="float:right"><br><br>
            <label for="location">Location: </label>
            <input name="location" type="text" style="float:right"><br><br>
            <label for="dateCut">Date Cut: </label>
            <input name="dateCut" type="date" style="float:right"><br><br>
            <label for="user_cut">Cut by: </label>
            <input name="user_cut" type="text" style="float:right"><br><br>
            <label for="ply">Ply: </label>
            <input name="ply" type="number" step="1" style="float:right"><br><br>
            <label for="mass_nb">Mass before (g): </label>
            <input name="mass_nb" type="number" step="0.01" style="float:right"><br><br>
            <label for="dateOven">Date put into Oven: </label>
            <input name="dateOven" type="date" style="float:right"><br><br>
            <label for="user_bagged">Bagged by: </label>
            <input name="user_bagged" type="text" style="float:right"><br><br>
            <label for="num_wax_coats">Number of wax coats: </label>
            <input name="num_wax_coats" type="number" step="1" min="0" style="float:right"><br><br>
            <label for="bagUseTimes">Times Bag used Previously: </label>
            <input name="bagUseTimes" type="number" step="1" min="0" style="float:right"><br><br>
            <label for="curing_stackup">Curing stackup: </label>
            <input name="curing_stackup" type="text" style="float:right"><br><br>
            <label for="ovenStart">Time of Oven Start: </label>
            <input name="ovenStart" type="time" style="float:right"><br><br>
            <label for="ovenReach107">Time Reached 107: </label>
            <input type="time" name="ovenReach107" style="float:right"><br><br>
            <label for="user_check1">Checked (1) by: </label>
            <input name="user_check1" type="text" style="float:right"><br><br>
            <label for="timeRamp">Time Began Ramping: </label>
            <input name="timeRamp" type="time" style="float:right"><br><br>
            <label for="user_ramp">Ramped up by: </label>
            <input name="user_ramp" type="text" style="float:right"><br><br>
            <label for="ovenReach177">Time Reached 177: </label>
            <input name="ovenReach177" type="time" style="float:right"><br><br>
            <label for="user_check2">Checked (2) by: </label>
            <input name="user_check2" type="text" style="float:right"><br><br>
            <label for="timeOvenOff">Time turned off: </label>
            <input name="timeOvenOff" type="time" style="float:right"><br><br>
            <label for="user_check3">Checked (3) by: </label>
            <input name="user_check3" type="text" style="float:right"><br><br>
            <label for="timeRemoved">Time Removed: </label>
            <input name="timeRemoved" type="time" style="float:right"><br><br>
            <label for="user_remove">Removed by: </label>
            <input name="user_remove" type="text" style="float:right"><br><br>
            <label for="lengthOutside">Length Outside (inches): </label>
            <input name="lengthOutside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="lengthInside">Length Inside (inches): </label>
            <input name="lengthInside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="heightOutside">Height Outside (inches): </label>
            <input name="heightOutside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="heightInside">Height Inside (inches): </label>
            <input name="heightInside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="mass_after">Mass after (g): </label>
            <input name="mass_after" type="number" step="0.001" style="float:right"><br><br>
            <label for="thickness1">Edge Thickness 1 (mm): </label>
            <input name="thickness1" type="number" step="0.001" style="float:right"><br><br>
            <label for="thickness2">Edge Thickness 2 (mm): </label>
            <input name="thickness2" type="number"step="0.001" style="float:right"><br><br>
            <label for="thickness3">Edge Thickness 3 (mm): </label>
            <input name="thickness3" type="number" step="0.001" style="float:right"><br><br>
            <label for="thickness4">Edge Thickness 4 (mm): </label>
            <input name="thickness4" type="number" step="0.001" style="float:right"><br><br>
            <label for="bow">Bow (mm): </label>
            <input name="bow" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="user_measure">Measured by: </label>
            <input name="user_measure" type="text" style="float:right"><br><br>
          </div>
          <input class="button" type="submit" name="submit" value="Submit">
        </form>
      </main>
    </div>
  </body>
</html>
