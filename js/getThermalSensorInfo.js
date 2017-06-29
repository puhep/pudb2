var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Name",
    "Sensor Type",
    "Color",
    "Current Channel",
    "Status"
  ];

  dbArray = [
    dbJSON.name,
    dbJSON.sensor_type,
    dbJSON.color,
    dbJSON.cur_channel,
    dbJSON.status
  ];
}
