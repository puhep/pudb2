<!DOCTYPE html>
<?php
  require_once("database.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql="SELECT * FROM sheet where id=$id";
  $data=$db->db_query($sql);
  $data=$data[0];
  $name=$data['name'];
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title>Edit <?php echo $name; ?></title>
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
        <h1>Edit <?php echo $name; ?></h1>
        <form action="sheet_edit_proc.php" method="post" enctype="multipart/form-data">
          <div style="width:400px;">
            <label for="name">Name: </label>
            <input placeholder= "<?php echo $data['name']; ?>" name="name" type="text" style="float:right"><br><br>
            <label for="location">Location: </label>
            <input placeholder= "<?php echo $data['location']; ?>" name="location" type="text" style="float:right"><br><br>
            <label for="dateCut">Date Cut: </label>
            <input placeholder= "<?php echo $data['dateCut']; ?>" name="dateCut" type="date" id="datepicker" style="float:right"><br><br>
            <label for="user_cut">Cut by: </label>
            <input placeholder= "<?php echo $data['user_cut']; ?>" name="user_cut" type="text" style="float:right"><br><br>
            <label for="ply">Ply: </label>
            <input placeholder= "<?php echo $data['ply']; ?>" name="ply" type="number" step="1" style="float:right"><br><br>
            <label for="mass_nb">Mass before (g): </label>
            <input placeholder= "<?php echo $data['mass_nb']; ?>" name="mass_nb" type="number" step="0.01" style="float:right"><br><br>
            <label for="dateOven">Date put into Oven: </label>
            <input placeholder="<?php echo $data['dateOven']; ?>" name="dateOven" type="date" style="float:right"><br><br>
            <label for="user_bagged">Bagged by: </label>
            <input placeholder= "<?php echo $data['user_bagged']; ?>" name="user_bagged" type="text" style="float:right"><br><br>
            <label for="num_wax_coats">Number of wax coats: </label>
            <input placeholder= "<?php echo $data['num_wax_coats']; ?>" name="num_wax_coats" type="number" step="1" min="0" style="float:right"><br><br>
            <label for="bagUseTimes">Times Bag used Previously: </label>
            <input placeholder="<?php echo $data['bagUseTimes']; ?>" name="bagUseTimes" type="number" step="1" min="0" style="float:right"><br><br>
            <label for="checkedLeaks">Vacuum Bag Checked for Leaks</label>
            <select class="YesNo" name="checkedLeaks" style="float:right">
              <option value="N/A"></option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select><br><br>
            <label for="curing_stackup">Curing stackup: </label>
            <input placeholder= "<?php echo $data['curing_stackup']; ?>" name="curing_stackup" type="text" style="float:right"><br><br>
            <label for="cfType">Carbon Fiber Type:</label>
            <input placeholder="<?php echo $data['cfType']; ?>" name="cfType" type="text" style="float:right"><br><br>
            <label for="cfQuality">Carbon Fiber Quality:</label>
            <input placeholder="<?php echo $data['cfQuality']; ?>" name="cfQuality" type="text" style="float:right"><br><br>
            <label for="ovenStart">Time of Oven Start: </label>
            <input placeholder="<?php echo $data['ovenStart']; ?>" name="ovenStart" type="time" style="float:right"><br><br>
            <label for="ovenReach107">Time Reached 107: </label>
            <input placeholder="<?php echo $data['ovenReach107']; ?>" type="time" name="ovenReach107" style="float:right"><br><br>
            <label for="user_check1">Checked (1) by: </label>
            <input placeholder= "<?php echo $data['user_check1']; ?>" name="user_check1" type="text" style="float:right"><br><br>
            <label for="timeRamp">Time Began Ramping: </label>
            <input placeholder="<?php echo $data['timeRamp']; ?>" name="timeRamp" type="time" style="float:right"><br><br>
            <label for="user_ramp">Ramped up by: </label>
            <input placeholder= "<?php echo $data['user_ramp']; ?>" name="user_ramp" type="text" style="float:right"><br><br>
            <label for="ovenReach177">Time Reached 177: </label>
            <input placeholder="<?php echo $data['ovenReach177']; ?>" name="ovenReach177" type="time" style="float:right"><br><br>
            <label for="user_check2">Checked (2) by: </label>
            <input placeholder= "<?php echo $data['user_check2']; ?>" name="user_check2" type="text" style="float:right"><br><br>
            <label for="timeOvenOff">Time turned off: </label>
            <input placeholder="<?php echo $data['timeOvenOff']; ?>" name="timeOvenOff" type="time" style="float:right"><br><br>
            <label for="user_check3">Checked (3) by: </label>
            <input placeholder= "<?php echo $data['user_check3']; ?>" name="user_check3" type="text" style="float:right"><br><br>
            <label for="timeRemoved">Time Removed: </label>
            <input placeholder="<?php echo $data['timeRemoved']; ?>" name="timeRemoved" type="time" style="float:right"><br><br>
            <label for="user_remove">Removed by: </label>
            <input placeholder= "<?php echo $data['user_remove']; ?>" name="user_remove" type="text" style="float:right"><br><br>
            <label for="lengthOutside">Length Outside (inches): </label>
            <input placeholder="<?php echo $data['lengthOutside']; ?>" name="lengthOutside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="lengthInside">Length Inside (inches): </label>
            <input placeholder="<?php echo $data['lengthInside']; ?>" name="lengthInside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="heightOutside">Height Outside (inches): </label>
            <input placeholder="<?php echo $data['heightOutside']; ?>" name="heightOutside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="heightInside">Height Inside (inches): </label>
            <input placeholder="<?php echo $data['heightInside']; ?>" name="heightInside" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="mass_after">Mass after (g): </label>
            <input placeholder= "<?php echo $data['mass_after']; ?>" name="mass_after" type="number" step="0.001" style="float:right"><br><br>
            <label for="avgThickness">Average Thickness</label>
            <input placeholder="<?php echo $data['avgThickness'] ?>" name="avgThickness" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="minThickness">Minimum Thicknes</label>
            <input placeholder="<?php echo $data['minThickness'] ?>" name="minThickness" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="maxThickness">Maximum Thickness</label>
            <input placeholder="<?php echo $data['maxThickness'] ?>" name="maxThickness" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="thickness1">Edge Thickness 1 (mm): </label>
            <input placeholder= "<?php echo $data['thickness1']; ?>" name="thickness1" type="number" step="0.001" style="float:right"><br><br>
            <label for="thickness2">Edge Thickness 2 (mm): </label>
            <input placeholder= "<?php echo $data['thickness2']; ?>" name="thickness2" type="number"step="0.001" style="float:right"><br><br>
            <label for="thickness3">Edge Thickness 3 (mm): </label>
            <input placeholder= "<?php echo $data['thickness3']; ?>" name="thickness3" type="number" step="0.001" style="float:right"><br><br>
            <label for="thickness4">Edge Thickness 4 (mm): </label>
            <input placeholder= "<?php echo $data['thickness4']; ?>" name="thickness4" type="number" step="0.001" style="float:right"><br><br>
            <label for="bow">Bow (mm): </label>
            <input placeholder="<?php echo $data['bow']; ?>" name="bow" type="number" step="0.00001" min="0" style="float:right"><br><br>
            <label for="user_measure">Measured by: </label>
            <input placeholder= "<?php echo $data['user_measure']; ?>" name="user_measure" type="text" style="float:right"><br><br>
          </div>
          <h2>Notes</h2>
          <?php echo nl2br($notes); ?>
          <br>
          <div style="width:400px;">
              <label for="notes">Additional Notes: </label>
              <textarea cols="40" rows="5" name="notes"></textarea><br>
          </div>
          <h2>Pictures</h2>
          <div style="width:475px;">
            <label for="pic">Picture File: </label>
            <input name="pic" type="file" style="float:right"><br><br>
          </div>
          <div style="width:400px;">
            <label for="picnotes">Picture Notes: </label>
            <input name="picnotes" type="text" style="float:right"><br><br>
          </div>
          <h2>Misc Files</h2>
          <div style="width:475px;">
            <label for="thicknessContour">Sheet Thickness Contour<br>CSV file type only</label>
            <input name="thicknessContour" type="file" style="float:right">
          </div>
          <br><br>
          <div style="width:475px;">
            <label for="bowContour">Sheet Bow Contour<br>CSV file type only</label>
            <input name="bowContour" type="file" style="float:right">
          </div>
          <br><br>
          <div style="width:475px;">
            <label for="files[]">Misc File(s): </label>
            <input name="files[]" id="files" type="file" multiple="multiple" style="float:right"><br><br>
          </div>
          <?php
            echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
            $time = date('m-d-Y H:i:s');
            echo "<input type='hidden' name='lastEdit' value='".$time."'>";
          ?>
          <input class="button" type="submit" name="submit" value="Submit">
        </form>
        <br><br>
        <form method="get" action="sheet.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Part Summary">
        </form>
      </main>
    </div>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="./node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>x
    <script type="text/javascript">
      $(function() {
        $('input[type="date"]').datepicker();
      })
    </script>
  </body>
</html>
