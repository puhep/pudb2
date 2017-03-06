<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");

$id = $_POST['id'];
$db = new Database();

### update miscellaneous info if the fields have been filled
if($_POST['name'] != ""){
    $sql = "update support_structure set name=\"".$_POST['name']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['mass'] != ""){
    $sql = "update support_structure set mass=\"".$_POST['mass']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['pipe_material'] != ""){
    $sql = "update support_structure set pipe_material=\"".$_POST['pipe_material']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['pipe_wall_thickness'] != ""){
    $sql = "update support_structure set pipe_wall_thickness=\"".$_POST['pipe_wall_thickness']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['foam_type'] != ""){
    $sql = "update support_structure set foam_type=\"".$_POST['foam_type']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['wings_ply'] != ""){
    $sql = "update support_structure set wings_ply=\"".$_POST['wings_ply']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['airex_stack'] != ""){
    $sql = "update support_structure set airex_stack=\"".$_POST['airex_stack']."\" where id=$id";
    $db -> query($sql);
}

### this concatenates existing notes, if any, with a new line including the date and the entered note text
if($_POST['notes'] != ""){
    $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"support_structure\"";
    $db -> query($sql);
}

### if the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
if($_FILES['pic']['name'] != ""){
    $picupload=1;
    #echo "pic detected<br>";
    $targetdir = "../phase_2/pics/support_structure/$id/";
    $targetfile = $targetdir.$_FILES['pic']['name'];
    $imageFileType = pathinfo($targetfile,PATHINFO_EXTENSION);
    ### if the directory for the test does not exist, create it and make it editable
    if(!file_exists($targetdir)){
        mkdir($targetdir);
        chmod($targetdir,0777);
	}
    ### don't allow duplicate uploads
    if (file_exists($targetfile)) {
        echo "Sorry, file already exists.<br>".$backmessage;
        $picupload = 0;
    }
    ### only picture type files are allowed
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>".$backmessage;
    $picupload = 0;
}
    ### if none of the errors have been detected, proceed with the upload
    if($picupload==1){
    #echo "ok to upload";
    move_uploaded_file($_FILES['pic']['tmp_name'], $targetfile);
    $fp = fopen(substr($targetfile,0,-3)."txt","w");
    $date = date("m-d-y H:i:s");
    #echo $date;
    fwrite($fp,$date." ".$_POST['picnotes']."\n");
    fclose($fp);
}
}
    
    ### if the name of the file is not blank (i.e. a file has been slotted to upload), attempt to upload
    if($_FILES['file']['name'] != ""){
    #echo "file detected<br>";
    $targetdir = "../phase_2/files/support_structure/$id/";
    $targetfile = $targetdir.$_FILES['file']['name'];
    ### if the directory for the structure does not exist, create it and make it editable
    if(!file_exists($targetdir)){
    mkdir($targetdir);
    chmod($targetdir,0777);
}
    move_uploaded_file($_FILES['file']['tmp_name'], $targetfile);
}
    
    ### redirect to the structure summary page with the new information
    header("Location: ss_summary.php?id=$id");
    
    
?>
