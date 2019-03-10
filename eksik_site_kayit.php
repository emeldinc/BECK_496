<?php
include('dbconnection.php');

$value = $_POST;
$sql = "INSERT INTO site (name, city, state, postal_code)
VALUES ('".$value['site_adi']."', '".$value['sehir']."', '".$value['ilce']."', '".$value['posta_kodu']."')";

if ($db->query($sql) === TRUE) {
	$insert_id = $db->insert_id;
    header("location: eksik_apartman_bilgileri.php?insert_id=$insert_id");
    $db->close();
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>