<?php 

    if(session_id() == '')
    session_start();
    include('dbconnection.php');

   
    $gelir_gider_id = $_GET['gelir_gider_id'];

    $sql = "DELETE FROM beckdoor.gelir_gider
    WHERE id = '".$gelir_gider_id."'";

    if(mysqli_query($db,$sql)) {
        header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }

   



    ?>