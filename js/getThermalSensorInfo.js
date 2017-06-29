var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);
  if (dbJSON.lastEdit == null) {
    dbJSON.lastEdit = 'Not yet recorded';
  }
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

  fieldArray = [
    'color',
    'cur_channel',
    'status'
  ];
}
