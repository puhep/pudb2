var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Name",
    "Si Thickness",
    "Adhesive",
    "Geometry"
  ];

  dbArray = [
    dbJSON.name,
    dbJSON.si_thickness,
    dbJSON.adhesive,
    dbJSON.geometry
  ];
}
