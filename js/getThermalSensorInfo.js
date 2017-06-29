var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Color",
    "Current Channel",
    "Status"
  ];

  dbArray = [
    dbJSON.color,
    dbJSON.cur_channel,
    dbJSON.status
  ];
}
