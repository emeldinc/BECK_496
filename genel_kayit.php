<?php
    include 'dbconnection.php';
    if(session_id() == '')
        session_start();

    if(isset($_POST['username'])) {
        $user_id = "";
        $username = $_POST['username'];
        $password = substr(md5($_POST['password']), 0, 30);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        $image_path = "assets/images/no-image.jpeg";

        $sql = "INSERT INTO beckdoor.user (username,password, firstname, lastname, role, image_path)
        VALUES ('$username','$password','$firstname', '$lastname','$role','$image_path')";

        if (mysqli_query($db, $sql))
        {
            $user_id = $db->insert_id;
            $sql = "SELECT * FROM user WHERE `id` = $user_id";
            $res = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($res);
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_role'] = $role;
            $_SESSION['image_path'] = $image_path;
            $_SESSION['daire_id'] = '';
            $_SESSION['site_id'] = '';
            $_SESSION['apartman_id'] = '';
            header('location: eksik_site_bilgileri.php');
        }
        else {
            echo $db->error;
            echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
        }
    }



    if(isset($_POST['site_secenek']))
    {
        $site_id;
        $apartman_id;
        $site_secenek = $_POST['site_secenek'];
        if($site_secenek == "-1")
        {
            $sql = "INSERT INTO beckdoor.site (name, city, state, postal_code)
                    VALUES ('".$_POST['site_adi']."', '".$_POST['sehir']."', '".$_POST['ilce']."', '".$_POST['posta_kodu']."')";
            if ($db->query($sql) === TRUE) {
                $site_id = $db->insert_id;
            }
            else
                echo $db->error;
        }
        else
        {
            if($site_secenek == "-2")
                $site_id = "NULL";
            else
                $site_id = $_POST['site_secenek'];
        }

        if($_POST['apartman_secenek'] == "-1")
        {
            $sql = "INSERT INTO `apartman` (`ref_site_id`,`name`,`number`) VALUES ($site_id,'".$_POST['apartman_adi']."','".$_POST['apartman_numara']."')";
            if ($db->query($sql) === TRUE)
                $apartman_id = $db->insert_id;
            else
                echo "<script> alert('". $db->error . "') </script>";
        }
        else
        {
            $apartman_id = $_POST['apartman_secenek'];
        }
        $sql_for_daire = "INSERT INTO beckdoor.daire (`ref_apartman_id`,`number`)
                          VALUES ('$apartman_id',".$_POST['daire_numara'].")";

        if ($db->query($sql_for_daire))
        {
            $sql_for_user_daire = "INSERT INTO beckdoor.user_daire (ref_user_id, ref_daire_id)
                                   VALUES (".$_SESSION['user_id'].",".$db->insert_id.")";
            $db->query($sql_for_user_daire);
        }
        else
            echo "<script> alert('". $db->error . "') </script>";
    }
?>