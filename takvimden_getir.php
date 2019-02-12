<?php 

include("dbconnection.php");

session_start();
$apartman_id = $_SESSION['apartman_id'];
$site_id = $_SESSION['site_id'];

$result_array = array();

$sql = "SELECT id,description as title,start_date as start FROM beckdoor.etkinlik WHERE ref_apartman_id = '".$apartman_id."' AND ref_site_id = '".$site_id."' AND start_date IS NOT NULL";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$row['url'] = "takvimden_sil.php?event_id=".$row['id'];
        array_push($result_array, $row);
    }
}

echo json_encode($result_array);



?>