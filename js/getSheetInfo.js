/*******************************************
* Calls converts sheet JSON to an array
*
* @ToDo: Make it work for any
*******************************************/

var dbJSON;
var dbArray;
/*******************************************
*
* function is currently not being used
*
* this is writen in the test-react file
*
* problem was the page would load before the ajax could finish calling php
*
*******************************************/
function sheetInfo(id) {
  $.ajax({
    url: 'php/getSheetData.php?id=' + id,
    success: JSONtoArray,
  }).fail(function() {
    console.log('failed');
  });
}
function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    'Name',
    'Location',
    'Date Cut',
    'Ply',
    'Mass Before Backing',
    'Cut By',
    'Date put into Oven',
    'Bagged/Oven Turned on By',
    'Number of Wax Coats',
    'Number of Times Bag was used Previously',
    'Vacuum Bag Checked for Leaks',
    'Curing Stackup',
    'Time of Oven Start',
    'Time Reached 107',
    'Checked (1) By',
    'Time Began Ramping',
    'Ramped up By',
    'Time Reached 177',
    'Checked (2) By',
    'Time Shut Off',
    'Checked (3) By',
    'Time Removed',
    'Removed By',
    'Length Outside',
    'Length Inside',
    'Height Outside',
    'Height Inside',
    'Mass After',
    'Thickness 1',
    'Thickness 2',
    'Thickness 3',
    'Thickness 4',
    'Bow',
    'Measured By'
  ];

  dbArray = [
    dbJSON.name,
    dbJSON.location,
    dbJSON.dateCut,
    dbJSON.ply,
    dbJSON.mass_nb,
    dbJSON.user_cut,
    dbJSON.dateOven,
    dbJSON.user_bagged,
    dbJSON.num_wax_coats,
    dbJSON.bagUseTimes,
    dbJSON.checkedLeaks,
    dbJSON.curing_stackup,
    dbJSON.ovenStart,
    dbJSON.ovenReach107,
    dbJSON.user_check1,
    dbJSON.timeRamp,
    dbJSON.user_ramp,
    dbJSON.ovenReach177,
    dbJSON.user_check2,
    dbJSON.timeOvenOff,
    dbJSON.user_check3,
    dbJSON.timeRemoved,
    dbJSON.user_remove,
    dbJSON.lengthOutside,
    dbJSON.lengthInside,
    dbJSON.heightOutside,
    dbJSON.heightInside,
    dbJSON.mass_after,
    dbJSON.thickness1,
    dbJSON.thickness2,
    dbJSON.thickness3,
    dbJSON.thickness4,
    dbJSON.bow,
    dbJSON.user_measure,
  ];
}
