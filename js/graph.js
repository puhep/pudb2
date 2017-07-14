function TempVsTime(response) {
  var data = [];
  graphData = JSON.parse(response);
  for (i = 0; i < graphData.sensor.length; i++) {
    var y = [];
    var x = [];
    for (j = 0; j < graphData.size; j++) {
      if (graphData.sensor[i][j][1] < 160) {
        x.push(graphData.sensor[i][j][0]);
        y.push(graphData.sensor[i][j][1]);
      }
    } // End of loop; entries
    var name = graphData.text[i];
    var trace = {
      y: y,
      x: x,
      marker: {
        size: 12
      },
      mode: 'lines',
      type: 'scatter',
      name: name
    };
    data.push(trace);
  } // End of loop;
  var layout = {
    yaxis: {
      showgrid: false,
      title: 'Temperature'
    },
    xaxis: {
      showgrid: false,
      title: 'Time'
    },
    title: 'Temperature VS Time'
  };
  Plotly.newPlot('tempVsTimePlot', data, layout);
}
function avgTemp(response) {
  dbJSON = JSON.parse(response);
  var data = [];
  for (i = 0; i < dbJSON.size.length; i++) {
    var y = [
      dbJSON.avgTemp[i],
      dbJSON.errMax[i],
      dbJSON.errMin[i]
    ];
    var name = dbJSON.avgChan[i];
    var trace = {
      y: y,
      type: 'box',
      name: name,
    };
    data.push(trace);
  } // End of for loop
  var layout = {
    title: 'Average Temperature'
  };
  Plotly.newPlot('avgTempPlot', data, layout);
}
function sheetContour(response) {
  graphData = JSON.parse(response);
  var data = [
    {
      x: graphData.x,
      y: graphData.y,
      z: graphData.z,
      type: "contour"
    }
  ];
  var layout = {
    title: "Contour"
  };
  // Display plot
  Plotly.newPlot("contourPlot", data, layout);
}
function sheetMesh(response) {
  graphData = JSON.parse(response);
  var data = [
    {
      x: graphData.x,
      y: graphData.y,
      z: graphData.z,
      type: 'mesh3d',
      opacity: 0.8,
      color: 'rgb(171,154,164)'
    }
  ];

  var layout = {
    title: "Mesh",
  };

  Plotly.newPlot("meshPlot", data, layout);
}
function thickVsDate(response) {
  graphData = JSON.parse(response);
  var ply3 = {
    x: graphData.x3,
    y: graphData.y3,
    text: graphData.name3,
    name: '3 Ply',
    marker: {
      size: 12,
      color: 'red'
    },
    mode: 'markers',
    type: 'scatter'
  };
  var ply8 = {
    x: graphData.x8,
    y: graphData.y8,
    text: graphData.name8,
    name: '8 Ply',
    marker : {
      size: 12,
      color: 'blue'
    },
    mode: 'markers',
    type: 'scatter'
  }
  var layout = {
    xaxis: {
      showgrid: false,
    },
    title: 'Sheet Thickness Vs Date'
  };
  var data = [ply3, ply8];
  Plotly.newPlot('thicknessPlot', data, layout);
}
