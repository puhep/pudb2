var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);
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
