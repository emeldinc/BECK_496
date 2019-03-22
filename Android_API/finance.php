<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-type: application/json; charset=utf-8');

include '../dbconnection.php';

$response = array("error" => FALSE,"finances" => array());
$apartman_id = $_GET['finance'];

$sql = "SELECT * FROM `daire` WHERE `ref_apartman_id` = $apartman_id";
$outerres = mysqli_query($db,$sql);
while($outerrow = mysqli_fetch_assoc($outerres))
{
    $sql = "SELECT * FROM `aidat` WHERE `ref_daire_id` = ".$outerrow['id'];
    $res = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($res))
    {
        $finance = array();
        $finance['type'] = "aidat";
        $finance['daire_id'] = $row['ref_daire_id'];
        $finance['amount'] = $row['amount'];
        $finance['date'] = $row['date'];
        $finance['odendiMi'] = $row['odendiMi'];
        array_push($response['finances'],$finance);
    }
}
$sql = "SELECT * FROM `gelir_gider` WHERE `ref_apartman_id` = $apartman_id";
$res = mysqli_query($db,$sql);
while($row = mysqli_fetch_assoc($res))
{
    $finance = array();
    $finance['type'] = "gelir_gider";
    $finance['amount'] = $row['amount'];
    $finance['date'] = $row['date'];
    $finance['gelirMi'] = $row['gelirMi'];
    array_push($response['finances'],$finance);
}
echo json_encode($response);


?>