<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');

    $username = $_POST['username'];
    $password = substr(md5($_POST['password']),0,30);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $image_path = "assets/images/no-image.jpeg";

    $sql = "INSERT INTO beckdoor.user (username,password, firstname, lastname, role, image_path)
    VALUES ('$username','$password','$firstname', '$lastname','$role','$image_path')";

    if (mysqli_query($db,$sql)) {
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($res);
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_role'] = $role;
        $_SESSION['image_path'] = $image_path;
        $_SESSION['daire_id'] = '';
        $_SESSION['site_id'] = '';
        $_SESSION['apartman_id'] = '';
        header('location: eksik_site_bilgileri.php');
    } else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }



?>
