<!--
  *
  * Queries the database for for all sheet data and then puts them into a JSON
  * object and returns it.
  *
 -->

<?php
  require_once("database.php");
  $db = new Database();
  $id = $_GET['id'];

  $sql = "SELECT * FROM sheet WHERE id=$id;";
  $result = $db->db_query($sql);
  $result = $result[0];

  $return = new stdClass;
  $return->name           = $result['name'];
  $return->ply            = $result['ply'];
  $return->user_cut       = $result['user_cut'];
  $return->user_bagged    = $result['user_bagged'];
  $return->user_check1    = $result['user_check1'];
  $return->user_check2    = $result['user_check2'];
  $return->user_check3    = $result['user_check3'];
  $return->user_ramp      = $result['user_ramp'];
  $return->user_remove    = $result['user_remove'];
  $return->user_measure   = $result['user_measure'];
  $return->mass_nb        = $result['mass_nb'];
  $return->num_wax_coats  = $result['num_wax_coats'];
  $return->curing_stackup = $result['curing_stackup'];
  $return->mass_after     = $result['mass_after'];
  $return->num_bag_used   = $result['num_bag_used'];
  $return->location       = $result['location'];
  $return->thickness1     = $result['thickness1'];
  $return->thickness2     = $result['thickness2'];
  $return->thickness3     = $result['thickness3'];
  $return->thickness4     = $result['thickness4'];
  $return->lastEdit       = $result['lastEdit'];
  $return->dateCut        = $result['dateCut'];
  $return->dateOven       = $result['dateOven'];
  $return->bagUseTimes    = $result['bagUseTimes'];
  $return->ovenStart      = $result['ovenStart'];
  $return->ovenReach107   = $result['ovenReach107'];
  $return->timeRamp       = $result['timeRamp'];
  $return->ovenReach177   = $result['ovenReach177'];
  $return->timeOvenOff    = $result['timeOvenOff'];
  $return->timeRemoved    = $result['timeRemoved'];
  $return->lengthOutside  = $result['lengthOutside'];
  $return->lengthInside   = $result['lengthInside'];
  $return->heightOutside  = $result['heightOutside'];
  $return->heightInside   = $result['heightInside'];
  $return->bow            = $result['bow'];
  $json = json_encode($return);
  echo $json;
?>
