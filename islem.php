<?php
    include('dbconnection.php');
    if(session_id() =='')
      session_start();

    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = substr(md5($_POST['password']), 0, 30);
        $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' ";
        $res = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($res);
        if (mysqli_affected_rows($db) >= 1) {
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            echo "<script> confirm('Kullanici bulunamadi...') </script>";
            header('location:login.php');
        }

        //echo $username;

        if (isset($_POST['beni_hatirla'])) {
            //cookie atayalim
            setcookie($_POST['username'], strtotime("+1 day"));
            setcookie($_POST['password'], strtotime("+1 day"));
        } else {
            //cookie sil
            setcookie($_POST['username'], strtotime("-1 day"));
            setcookie($_POST['password'], strtotime("-1 day"));
        }
    }
?>
