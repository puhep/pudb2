var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);
  if (dbJSON.lastEdit == null) {
    dbJSON.lastEdit = 'Not yet recorded';
  }

  keyArray = [
    'Current Location',
    'Produced Location'
  ];

  dbArray = [
    dbJSON.currentLocation,
    dbJSON.prodLocation
  ];

  fieldArray = [
    'currentLocation',
    'prodLocation'
  ];
}
