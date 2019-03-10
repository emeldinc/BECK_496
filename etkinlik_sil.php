<?php 

include("dbconnection.php");
session_start();
$event_id = $_GET['event_id'];
$sql = "UPDATE etkinlik SET silindiMi = 1 WHERE id = '".$event_id."'";

if (mysqli_query($db,$sql)) {
        
} else {
    echo $db->error;
}




?>