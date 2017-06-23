var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Name",
    "Mass",
    "Pipe Material",
    "Pipe Wall Thickness",
    "Foam Type",
    "Ply of Wings",
    "Stack of Airex"
  ];

  dbArray = [
    dbJSON.name;
    dbJSON.mass;
    dbJSON.pipe_material,
    dbJSON.pipe_wall_thickness,
    dbJSON.foam_type,
    dbJSON.wings_ply,
    dbJSON.airex_stack
  ];
}
