<?php 

include("dbconnection.php");
session_start();
$apartman_id = $_SESSION['apartman_id'];
$site_id = $_SESSION['site_id'];
$description = $_GET['description'];
if($description == "") {
	$description = "Başlıksız Etkinlik";
}

$sql = "INSERT INTO beckdoor.etkinlik (description, ref_apartman_id, ref_site_id)
    VALUES ('".$description."','".$apartman_id."','".$site_id."')";

if (mysqli_query($db,$sql)) {
        
} else {
    echo $db->error;
}



?>