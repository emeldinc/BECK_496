<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-type: application/json; charset=utf-8');

include '../dbconnection.php';
include ('Utility.php');

$user_id = $_POST['user_id'];
$apartman_id = getApartmentID($_POST['house_id']);
$site_id = getSiteID($apartman_id);
$title = $_POST['title'];
$description = $_POST['description'];

$response = array("error" => FALSE,"duyurular" => array());

$sql = "INSERT INTO duyuru (ref_user_id,ref_apartman_id,ref_site_id,now_date,title,description)
  VALUES ('$user_id','$apartman_id','$site_id',NOW(),'".$title."','$description')";

if(mysqli_query($db,$sql))
    $response['error'] = TRUE;
echo json_encode($response);

?>