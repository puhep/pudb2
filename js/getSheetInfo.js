/*******************************************
* Calls converts sheet JSON to an array
*
* @ToDo: Make it work for any
*******************************************/

var dbJSON;
var dbArray;
var keyArray;
/*******************************************
*
* function is currently not being used
*
* this is writen in the test-react file
*
* problem was the page would load before the ajax could finish calling php
*
*******************************************/
function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
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
    'Average Thickness',
    'Minimum Thickness',
    'Maximum Thickness',
    'Thickness 1',
    'Thickness 2',
    'Thickness 3',
    'Thickness 4',
    'Bow',
    'Measured By'
  ];

  dbArray = [
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
    dbJSON.avgThickness,
    dbJSON.minThickness,
    dbJSON.maxThickness,
    dbJSON.thickness1,
    dbJSON.thickness2,
    dbJSON.thickness3,
    dbJSON.thickness4,
    dbJSON.bow,
    dbJSON.user_measure,
  ];

  fieldArray = [
    'location',
    'dateCut',
    'ply',
    'mass_nb',
    'user_cut',
    'dateOven',
    'user_bagged',
    'num_wax_coats',
    'bagUseTimes',
    'checkedLeaks',
    'curing_stackup',
    'ovenStart',
    'ovenReach107',
    'user_check1',
    'timeRamp',
    'user_ramp',
    'ovenReach177',
    'user_check2',
    'timeOvenOff',
    'user_check3',
    'timeRemoved',
    'user_remove',
    'lengthOutside',
    'lengthInside',
    'heightOutside',
    'heightInside',
    'mass_after',
    'avgThickness',
    'minThickness',
    'maxThickness',
    'thickness1',
    'thickness2',
    'thickness3',
    'thickness4',
    'bow',
    'user_measure',
  ];
}
