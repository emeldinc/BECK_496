<?php 

    if(session_id() == '')
    session_start();
    include('dbconnection.php');

   
    $aidat_id = $_GET['aidat_id'];

    $sql = "DELETE FROM aidat
    WHERE id = '".$aidat_id."'";

    if(mysqli_query($db,$sql)) {
        header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }

   



    ?>