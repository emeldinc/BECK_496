<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-type: application/x-wwww-form-urlencoded; charset=utf-8');

include '../dbconnection.php';
include ('Utility.php');

$user_id = $_GET['user_id'];
$apartman_id = getApartmentID($_GET['house_id']);
$site_id = getSiteID($apartman_id);
$title = $_GET['title'];
$description = $_GET['description'];

$response = array("error" => TRUE,"duyurular" => array());

$sql = "INSERT INTO duyuru (ref_user_id,ref_apartman_id,ref_site_id,now_date,title,description)
  VALUES ('$user_id','$apartman_id','$site_id',NOW(),'".$title."','$description')";

if(mysqli_query($db,$sql)) {
    $response['error'] = FALSE;
    $response['query'] = $sql;
}
echo json_encode($response);

?>