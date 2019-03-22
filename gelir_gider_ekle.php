<?php 
    session_start();
	include('dbconnection.php');
    
    $miktar = $_POST['miktar'];
    $gelirMi = $_POST['gelirMi'];
    $tarih = $_POST['tarih'];
    $apartman_id = $_SESSION['apartman_id'];
    $description =  $_POST['description'];
  
    $sql = "INSERT INTO gelir_gider (ref_apartman_id ,`date`,amount,description,gelirMi)
    VALUES ('".$apartman_id."','".$tarih."','".$miktar."','".$description."','".$gelirMi."')";

    if(mysqli_query($db,$sql)) {
    	header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }
?>