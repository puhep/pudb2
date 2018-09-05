var dbJSON;
var dbArray;
var keyArray;
var rsp;

function JSONtoArray(response) {
  rsp = response.replace(/&quot;/g, "\"")
  rsp = rsp.substring(rsp.indexOf('{'))
  rsp = rsp.substring(0, rsp.indexOf('}') + 1)
  dbJSON = JSON.parse(rsp)

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
