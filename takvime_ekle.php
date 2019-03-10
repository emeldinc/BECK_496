<?php 

include("dbconnection.php");
session_start();
$id = $_GET['event_id'];
$time = $_GET['date'];
$datetime = date('Y-m-d',strtotime($time));
$sql_select = "SELECT * FROM etkinlik WHERE id = '".$id."'";
$result = $db->query($sql_select);
$row = $result->fetch_assoc();

if(is_null($row['start_date'])) {
	$sql_update = "UPDATE etkinlik SET start_date = '".$datetime."' WHERE id = '".$id."'";
	if (mysqli_query($db,$sql_update)) {
	  
	} else {
	    echo $db->error;
	}
}
else {
	$sql_insert = "INSERT INTO etkinlik (start_date, description, ref_apartman_id, ref_site_id,silindiMi)
    VALUES ('".$datetime."','".$row['description']."','".$row['ref_apartman_id']."','".$row['ref_site_id']."',1)";
	if (mysqli_query($db,$sql_insert)) {
	  echo json_encode("sayfayi yenile");
	} else {
	    echo $db->error;
	}
}








?>