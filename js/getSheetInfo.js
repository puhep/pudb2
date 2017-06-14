/*******************************************
* Calls converts sheet JSON to an array
*
* @ToDo: Make it work for any
*******************************************/

var dbJSON;
var dbArray;
function sheetInfo(id) {
  $.ajax({
    url: 'php/getSheetData.php?id=' + id,
    success: function() {
      console.log('it worked');
    },
  }).fail(function() {
    console.log('failed');
  });
}
function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

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
    dbJSON.lastEdit
  ];
  console.log('dbJSON');
}
