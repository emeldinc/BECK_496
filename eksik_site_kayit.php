<?php
include('dbconnection.php');

$value = $_POST;
$sql = "INSERT INTO beckdoor.site (name, city, state, postal_code)
VALUES ('".$value['site_adi']."', '".$value['sehir']."', '".$value['ilce']."', '".$value['posta_kodu']."')";

if ($db->query($sql) === TRUE) {
    header('location: eksik_apartman_bilgileri.php');
    $db->close();
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>