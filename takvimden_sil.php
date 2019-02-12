<?php
include('dbconnection.php');
$id = $_GET['event_id'];
$sql = "DELETE FROM beckdoor.etkinlik WHERE id = '".$id."'";
if(mysqli_query($db, $sql)) {
	header('location:index.php');
}
else {
	echo "db error";
}

?>