<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL | E_STRICT);
$backmessage = "Please press back and try again.<br>";
require_once("database.php");

$id = $_POST['id'];
$db = new Database();

### update miscellaneous info if the fields have been filled
if($_POST['name'] != ""){
    $sql = "update sheet set name=\"".$_POST['name']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['ply'] != ""){
    $sql = "update sheet set ply=".$_POST['ply']." where id=$id";
    $db -> query($sql);
}
if($_POST['mass_nb'] != ""){
    $sql = "update sheet set mass_nb=".$_POST['mass_nb']." where id=$id";
    $db -> query($sql);
}
if($_POST['mass_after'] != ""){
    $sql = "update sheet set mass_after=".$_POST['mass_after']." where id=$id";
    $db -> query($sql);
}
if($_POST['num_wax_coats'] != ""){
    $sql = "update sheet set num_wax_coats=".$_POST['num_wax_coats']." where id=$id";
    $db -> query($sql);
}
if($_POST['curing_stackup'] != ""){
    $sql = "update sheet set curing_stackup=\"".$_POST['curing_stackup']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_cut'] != ""){
    $sql = "update sheet set user_cut=\"".$_POST['user_cut']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_bagged'] != ""){
    $sql = "update sheet set user_bagged=\"".$_POST['user_bagged']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check1'] != ""){
    #echo "found";
    $sql = "update sheet set user_check1=\"".$_POST['user_check1']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check2'] != ""){
    $sql = "update sheet set user_check2=\"".$_POST['user_check2']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_check3'] != ""){
    $sql = "update sheet set user_check3=\"".$_POST['user_check3']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_ramp'] != ""){
    $sql = "update sheet set user_ramp=\"".$_POST['user_ramp']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_measure'] != ""){
    $sql = "update sheet set user_measure=\"".$_POST['user_measure']."\" where id=$id";
    $db -> query($sql);
}
if($_POST['user_remove'] != ""){
    $sql = "update sheet set user_remove=\"".$_POST['user_remove']."\" where id=$id";
    $db -> query($sql);
}

### this concatenates existing notes, if any, with a new line including the date and the entered note text
if($_POST['notes'] != ""){
    $sql = "update notes set notetext= CONCAT(IFNULL(notetext,''),DATE_FORMAT(NOW(),'%m-%d-%y %T'),\" ".$_POST['notes']."\",'\n') where part_id=$id AND part_type=\"sheet\"";
    $db -> query($sql);
}

### if the name of the picture is not blank (i.e. a picture has been slotted to upload), perform several checks and upload
if($_FILES['pic']['name'] != ""){
    $picupload=1;
    #echo "pic detected<br>";
    $targetdir = "../phase_2/pics/sheet/$id/";
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
        $targetdir = "../phase_2/files/sheet/$id/";
    $targetfile = $targetdir.$_FILES['file']['name'];
    ### if the directory for the structure does not exist, create it and make it editable
    if(!file_exists($targetdir)){
        mkdir($targetdir);
        chmod($targetdir,0777);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], $targetfile);
    }
    
### redirect to the summary page with the new information
header("Location: sheet.php?id=$id");

?>