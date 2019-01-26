<?php
include('dbconnection.php');

$value = $_POST;
$sql = "INSERT INTO beckdoor.apartman (ref_site_id, name, `number`)
VALUES ('".$value['site_id']."', '".$value['isim']."', '".$value['numara']."')";

if ($db->query($sql) === TRUE) {
	$insert_id = $db->insert_id;
    header("location: eksik_daire_bilgileri.php?insert_id=$insert_id");
    $db->close();
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>