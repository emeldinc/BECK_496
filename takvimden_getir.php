<?php 

include("dbconnection.php");

session_start();
$apartman_id = $_SESSION['apartman_id'];
$site_id = $_SESSION['site_id'];

$result_array = array();

$sql = "SELECT id,description as title,start_date as start FROM etkinlik WHERE ref_apartman_id = '".$apartman_id."' AND ref_site_id = '".$site_id."' AND start_date IS NOT NULL";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$tarih = date("Y-m-d");
    	$etkinlik_tarihi = $row['start'];
    	if($tarih < $etkinlik_tarihi) {
    		$row['backgroundColor'] = '#38945A';
    	}
    	else if($tarih == $etkinlik_tarihi) {
    		$row['backgroundColor'] = '#D8BD36';
    	}
    	else if($tarih > $etkinlik_tarihi) {
    		$row['backgroundColor'] = '#D66E6E';
    	}
    	
    	$row['url'] = "takvimden_sil.php?event_id=".$row['id'];
        array_push($result_array, $row);
    }
}

echo json_encode($result_array);



?>