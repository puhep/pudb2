<?php
### display the geometry of a test's sensors using a plot
require_once("./jpgraph/src/jpgraph.php");
require_once("./jpgraph/src/jpgraph_scatter.php");
require_once("database.php");
require_once("functions.php");
$db = new Database();
$id=$_GET['id'];

$sensorData = sensorTestData($id,$db);
$heaterData = heaterTestData($id,$db);
$moduleData = moduleTestData($id,$db);

$i=0;
foreach($sensorData as $line){
if($line['sensorXPos'] !='' and $line['sensorYPos'] !=''){
$sx[$i]=$line['sensorXPos'];
$sy[$i]=$line['sensorYPos'];
$sname[$i]=$line['sensorName'];
$size=14;
$color="yellow";
$format[ strval($sx[$i]) ][ strval($sy[$i]) ] = array($size, $color);
$i++;
}
}
$i=0;
foreach($heaterData as $line){
if($line['heaterXPos'] !='' and $line['heaterYPos'] !=''){
$heater=1;
$hx[$i]=$line['heaterXPos'];
$hy[$i]=$line['heaterYPos'];
$hname[$i]=$line['heaterName'];
$size=14;
$color="red";
$format[ strval($hx[$i]) ][ strval($hy[$i]) ] = array($size, $color);
$i++;
}
}
$i=0;
foreach($moduleData as $line){
if($line['moduleXPos'] !='' and $line['moduleYPos'] !=''){
$module=1;
$mx[$i]=$line['moduleXPos'];
$my[$i]=$line['moduleYPos'];
$mname[$i]=$line['moduleName'];
$size=50;
$color="purple";
$format[ strval($mx[$i]) ][ strval($my[$i]) ] = array($size, $color);
$i++;
}
}

function FCallback($aYVal,$aXVal) {
// We need to access the global format array
global $format;
return array($format[ strval($aXVal) ][ strval($aYVal) ][0],'',
                 $format[ strval($aXVal) ][ strval($aYVal) ][1],'','');
}

$g = new Graph(800,800);
$g->SetScale("linlin",0,15,0,15);
$g->title->Set("Test ".$data[0]['tname']." Geometry");
$g->title->SetFont(FF_FONT1,FS_BOLD);

$g->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$g->yaxis->SetFont(FF_FONT1,FS_BOLD);
$g->yaxis->SetLabelMargin(15);
$g->xaxis->SetFont(FF_FONT1,FS_BOLD);
$g->xaxis->SetLabelMargin(15);

$g->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$g->img->SetMargin(50,50,50,50);
$g->SetMargin(50,50,50,50);
$g->SetFrame(true,'black',1);


if(count($mx)){

$sp3 = new Scatterplot($my,$mx);
$sp3->mark->SetType(MARK_SQUARE);
$sp3->mark->SetCallbackYX("FCallback");

$i=0;
foreach($mname as $point){
$txt[$i] = new Text();
$txt[$i]->Set($point);
$txt[$i]->SetScalePos($mx[$i],$my[$i]);
$txt[$i]->Align("center","center");
$txt[$i]->SetFont(FF_FONT1,FS_BOLD);
$g->Add($txt[$i]);
$i++;
}

$g->Add($sp3);

}

if(count($sx)){

$sp1 = new Scatterplot($sy,$sx);
$sp1->mark->SetType(MARK_FILLEDCIRCLE);
$sp1->mark->SetCallbackYX("FCallback");

$i=0;
foreach($sname as $point){
$txt[$i] = new Text();
$txt[$i]->Set($point);
$txt[$i]->SetScalePos($sx[$i],$sy[$i]);
$txt[$i]->Align("center","center");
$txt[$i]->SetFont(FF_FONT1,FS_BOLD);
$g->Add($txt[$i]);
$i++;
}

$g->Add($sp1);

}

if(count($hx)){

$sp2 = new Scatterplot($hy,$hx);
$sp2->mark->SetType(MARK_FILLEDCIRCLE);
$sp2->mark->SetCallbackYX("FCallback");

$i=0;
foreach($hname as $point){
$txt[$i] = new Text();
$txt[$i]->Set($point);
$txt[$i]->SetScalePos($hx[$i],$hy[$i]);
$txt[$i]->Align("center","center");
$txt[$i]->SetFont(FF_FONT1,FS_BOLD);
$g->Add($txt[$i]);
$i++;
}

$g->Add($sp2);

}



$g->Stroke();


?>
