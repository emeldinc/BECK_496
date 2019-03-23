<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-type: application/json; charset=utf-8');

    include ('../dbconnection.php');
    include ('Utility.php');

    $response = array("error" => FALSE);
    $username = $_GET['username'];
    $password = $_GET['password'];
    $password = substr(md5($password), 0, 30);
    $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
    $res = mysqli_query($db,$sql);
    if(mysqli_affected_rows($db) == 1)
    {
        http_response_code(200);
        $row = mysqli_fetch_assoc($res);
        $response['username'] = $row['username'];
        $response['user_id'] = $row['id'];
        $response['firstname'] = $row['firstname'];
        $response['lastname'] = $row['lastname'];
        $response['role'] = $row['role'];
        $response['house_id'] = array();

        $housesql = "SELECT * FROM `user_daire` WHERE `ref_user_id` = ".$row['id'];
        $houseres = mysqli_query($db,$housesql);
        while($houserow = mysqli_fetch_assoc($houseres))
            array_push($response['house_id'],$houserow['ref_daire_id']." ".getHouseNumber($houserow['ref_daire_id']));
    }
    else
    {
        $response['error'] = TRUE;
        $response['error_msg'] = "Invalid Username or Password...";
        $response['wrong_username'] = $username;
        $response['wrong_password'] = $password;
    }
    echo json_encode($response);

?>
