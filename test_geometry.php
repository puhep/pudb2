<?php
### display the geometry of a test's sensors using a plot
require_once("./jpgraph/src/jpgraph.php");
require_once("./jpgraph/src/jpgraph_scatter.php");
require_once("database.php");
require_once("functions.php");
$db = new Database();
$id=$_GET['id'];
$sql="SELECT t.name as tname,t.id,t.coolant_temp,s.*,s.id as sid,ss.id as ssid,ss.name as ss_name,st.xpos,st.ypos,st.channel FROM test t LEFT JOIN sensor_test st ON st.test_id=t.id LEFT JOIN thermal_sensor s ON st.thermal_id=s.id LEFT JOIN support_structure ss ON t.assoc_ss=ss.id where t.id=".$_GET['id'];
$data=db_query($sql,$db);
$pos=array();
$i=0;
foreach($data as $line){
    $x[$i]=$line['xpos'];
    $y[$i]=-1*$line['ypos'];
    $name[$i]=$line['name'];
    #if($name[$i]
    #echo "Name: ".$name[$i];
    #echo "; Pos: (".$pos[0][$i];
    #echo ", ".$pos[1][$i].")<br>";
    if(strpos($name[$i],"T") === 0){
        $size=12;
        $color="yellow";
        #echo "T<br>";
    }
    else{
        $size=12;
        $color="red";
$name[$i]="H";
        #echo "H<br>";
    }
    $format[ strval($x[$i]) ][ strval($y[$i]) ] = array($size, $color);
#print_r($format);
#echo "<br>";
    $i++;
}

function FCallback($aYVal,$aXVal) {
    // We need to access the global format array
    global $format;
    return array($format[ strval($aXVal) ][ strval($aYVal) ][0],'',
                 $format[ strval($aXVal) ][ strval($aYVal) ][1],'','');
}
function cb_negate($aVal) {
return round(-$aVal,2);
}

#print_r($pos[0]);
#print_r($pos[1]);
$g = new Graph(800,800);
$g->SetScale("linlin");
$g->title->Set("Test ".$data[0]['tname']." Geometry");
$g->title->SetFont(FF_FONT1,FS_BOLD);
$g->yaxis->SetLabelFormatCallback("cb_negate");
#$g->yaxis->SetTitle("Y");
$g->xaxis->title->Set("+X --->");
$g->yaxis->title->Set("<--- +Y");
 
$g->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$g->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$g->xaxis->SetPos( 'min' );

$g->img->SetMargin(50,50,50,50);
$g->SetMargin(50,50,50,50);
$g->SetFrame(true,'black',1);

$sp1 = new Scatterplot($y,$x);
$sp1->mark->SetType(MARK_FILLEDCIRCLE);
#$sp1->mark->SetWidth(10);
#$sp1->value->Show();
$sp1->mark->SetCallbackYX("FCallback");
$g->Add($sp1);


$i=0;
foreach($name as $point){
    #echo $point;
    $txt[$i] = new Text();
    $txt[$i]->Set($point);
    $txt[$i]->SetScalePos($x[$i],$y[$i]);
    $txt[$i]->Align("center","center");
$txt[$i]->SetFont(FF_FONT1,FS_BOLD);
    $g->Add($txt[$i]);
    $i++;
}

#$txt = new Text();
#$txt->Set($name[0]);
#echo $x[0];
#$txt->SetPos($x[0],$y[0]);
#$g-> Add($txt);

$g->Stroke();


?>