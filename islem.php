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

            $user_id = $_SESSION['user_id'];
            $select_sql = "SELECT * FROM user_daire WHERE ref_user_id = '".$user_id."'";
            $res2 = mysqli_query($db, $select_sql);
            $row2 = mysqli_fetch_assoc($res2);
            if (mysqli_affected_rows($db) >= 1) {
                header('location:index.php');
            }
            else {
                header('location:eksik_site_bilgileri.php');
            }
        } else {
            echo "<script> confirm('Kullanici bulunamadi...') </script>";
            header('location:login.php');
        }

        //echo $username;

        if (isset($_POST['beni_hatirla'])) {
            //cookie atayalim
            setcookie($_POST['username'], strtotime("+1 day"));
        } else {
            //cookie sil
            setcookie($_POST['username'], strtotime("-1 day"));
        }
    }
?>
