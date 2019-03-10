<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');
    
    $durum = $_GET['durum'];
    $aidat_id = $_GET['aidat_id'];

    $sql = "UPDATE aidat SET odendiMi ='".$durum."' WHERE id = '".$aidat_id."'";

    if (mysqli_query($db,$sql)) {
      header('location: aidat_takip_sayfasi.php');
    } else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }



?>