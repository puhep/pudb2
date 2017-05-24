<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $db = new Database();
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h4>Sheet Thickness Vs Date of Curing</h4>
        <?php
          require_once("./jpgraph/src/jpgraph.php");
          require_once("./jpgraph/src/jpgraph_scatter.php");
          require_once("database.php");
          require_once("functions.php");
          $db = new Database();

          // Setup Graph
          $graph = new Graph(800, 800);
          $graph->SetScale('linlin');
          $graph->SetColor('lightblue');
          $graph->SetMarginColor('#F9DAC6');

          // Setup Title
          $graph->title->Set("Thickness Over Date of Curing");
          $graph->title->SetFont(FF_FONT2, FS_BOLD);
          $graph->title->SetColor('#191919');

          // Setup X-Axis
          $graph->xaxis->SetFont(FF_FONT1, FS_BOLD);
          $graph->xaxis->SetLabelMargin(15);
          $graph->xaxis->SetTitle("Date of Curing", center);
          $graph->xaxis->SetTitleMargin(15);
          $graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
          $graph->xaxis->SetWeight(3);
          $graph->xaxis->title->SetColor('#191919');

          // Setup Y-Axis
          $graph->yaxis->SetFont(FF_FONT1, FS_BOLD);
          $graph->yaxis->SetLabelMargin(15);
          $graph->yaxis->SetTitle("Sheet Thickness", middle);
          $graph->yaxis->SetTitleMargin(15);
          $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
          $graph->yaxis->SetWeight(3);
          $graph->yaxis->title->SetColor('#191919');

          $graph->img->SetMargin(50,50,50,50);
          $graph->SetMargin(50,50,50,50);
          $graph->SetFrame(true, 'black', 1);

          // Create Scatter plot and add points to it
          /*
           *
           * $dataY = array();
           * $dataX = array();
           *
           */
        ?>
      </main>
    </div>
  </body>
</html>
