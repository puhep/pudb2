/*******************************************
* Calls converts sheet JSON to an array
*
* @ToDo: Make it work for any id
*******************************************/

var dbJSON;
var dbArray;
  $.ajax({
    url: '../php/getSheetData.php?id=6',
    success: test,
  })
function test(response) {
  dbJSON = JSON.parse(response);
  console.log(dbJSON);

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
    dbJSON.lastEdit,
  ];
}
