<?php 

include("dbconnection.php");

$id = $_GET['event_id'];
$time = $_GET['date'];
$datetime = date('Y-m-d',strtotime($time));

$sql_update = "UPDATE etkinlik SET start_date = '".$datetime."' WHERE id = '".$id."'";
	if (mysqli_query($db,$sql_update)) {
	  
	} else {
	    echo $db->error;
	} 

?>