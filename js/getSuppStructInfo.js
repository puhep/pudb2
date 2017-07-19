var dbJSON; // JSON object that holds all the values from the database
var dbArray; // Array made of select values from dbJSON
var keyArray; // Array to hold the key that matches the dbArray

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Mass",
    "Pipe Material",
    "Pipe Wall Thickness",
    "Foam Type",
    "Ply of Wings",
    "Stack of Airex"
  ];

  dbArray = [
    dbJSON.mass,
    dbJSON.pipe_material,
    dbJSON.pipe_wall_thickness,
    dbJSON.foam_type,
    dbJSON.wings_ply,
    dbJSON.airex_stack
  ];

  fieldArray = [
    'mass',
    'pipe_material',
    'pipe_wall_thickness',
    'foam_type',
    'wings_ply',
    'airex_stack'
  ];
}
