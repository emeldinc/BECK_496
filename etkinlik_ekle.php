<?php 

include("dbconnection.php");
session_start();
$apartman_id = $_SESSION['apartman_id'];
$site_id = $_SESSION['site_id'];
$description = $_GET['description'];
if($description == "") {
	$description = "Başlıksız Etkinlik";
}
$kontrol_sql = "SELECT * FROM beckdoor.etkinlik WHERE description = '".$description."' AND ref_apartman_id = '".$apartman_id."' AND ref_site_id =  '".$site_id."' AND silindiMi = 0";

$result = $db->query($kontrol_sql);

if ($result->num_rows == 0) {
    $sql = "INSERT INTO beckdoor.etkinlik (description, ref_apartman_id, ref_site_id)
    VALUES ('".$description."','".$apartman_id."','".$site_id."')";

	if (mysqli_query($db,$sql)) {
	  $insert_id = $db->insert_id;
	  echo json_encode($insert_id);
	} else {
	    echo $db->error;
	}
}
else {
	echo json_encode("etkinlik var");
}





?>