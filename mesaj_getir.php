<?php

include("dbconnection.php");
session_start();
$date = $_GET['date'];
$datetime = date('Y-m-d H:i:s',strtotime($date));

$apartman_id = $_SESSION['apartman_id'];
$site_id = $_SESSION['site_id'];
$user_id = $_SESSION['user_id'];

$sql_mesaj_getir = "SELECT * FROM mesaj WHERE ref_apartman_id = '".$apartman_id."' AND 
ref_site_id = '".$site_id."' AND
date = '".$datetime."' AND
sender != '".$user_id."'";

$result = $db->query($sql_mesaj_getir);
$result_array = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	array_push($result_array, $row);
    }
}

echo json_encode($result_array);


?>