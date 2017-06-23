var dbJSON;
var dbArray;
var keyArray;

function JSONtoArray(response) {
  dbJSON = JSON.parse(response);

  keyArray = [
    "Name"
  ];

  dbArray = [
    dbJSON.name;
  ];
}
