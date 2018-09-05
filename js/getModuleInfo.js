var dbJSON; // JSON object that holds all the values from the database
var dbArray; // Array made of select values from dbJSON
var keyArray; // Array to hold the key that matches the dbArray
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
    "Si Thickness (Microns)",
    "Adhesive",
    "Geometry"
  ];

  dbArray = [
    dbJSON.si_thickness,
    dbJSON.adhesive,
    dbJSON.geometry
  ];

  fieldArray = [
    'si_thickness',
    'adhesive',
    'geometry'
  ];
}
