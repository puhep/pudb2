var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Name",
    "Sensor Type",
    "Current Channel"
  ];

  dbArray = [
    dbJSON.name,
    dbJSON.sensor_type,
    dbJSON.cur_channel
  ];
}
