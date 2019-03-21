<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    include ('../dbconnection.php');


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
    }
    else
    {
        $response['error'] = TRUE;
        $response['error_msg'] = "Invalid Username or Password...";
        $response['wrong_username'] = $username;
        $response['wrong_password'] = $password;
    }
    echo json_encode($response);
/*
require_once 'update_user_info.php';
$db = new update_user_info();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];

    // get the user by email and password
    $user = $db->VerifyUserAuthentication($email, $password);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        $response["user"]["name"] = $user["name"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["age"] = $user["age"];
        $response["user"]["gender"] = $user["gender"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
*/
?>
