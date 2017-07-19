var dbJSON; // JSON object that holds all the values from the database
var dbArray; // Array made of select values from dbJSON
var keyArray; // Array to hold the key that matches the dbArray

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
