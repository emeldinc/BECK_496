<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');
	$user_id = $_SESSION['user_id'];
	$rol = $_POST['rol'];
	$sql = "UPDATE beckdoor.user SET role ='".$rol."' WHERE id = '".$user_id."'" ;

    if (mysqli_query($db,$sql)) {
    	$_SESSION['user_role'] = $rol;
      	header('location: role_degistir.php');
    } else {
        echo $db->error;
        echo "<script> alert('database hatası') </script>";
    }



?>
