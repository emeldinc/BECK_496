<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');

    $username = $_POST['username'];
    $password = substr(md5($_POST['password']),0,30);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];

    $sql = "INSERT INTO beckdoor.user (username,password, firstname, lastname, role)
    VALUES ('$username','$password','$firstname', '$lastname','$role')";

    if (mysqli_query($db,$sql)) {
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($res);
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['user_id'] = $row['id'];
        header('location: eksik_site_bilgileri.php');
    } else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }



?>
