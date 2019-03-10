<?php 

	if(session_id() == '')
    session_start();
	include('dbconnection.php');

    $miktar = $_POST['miktar'];
    $tarih = $_POST['tarih'];
    $gelir_gider_id = $_GET['gelir_gider_id'];
    $aciklama = $_POST['description'];

    $sql = "UPDATE gelir_gider SET amount = '".$miktar."', date = '".$tarih."',description = '".$aciklama."' 
    WHERE id = '".$gelir_gider_id."'";

    if(mysqli_query($db,$sql)) {
    	header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }

   



    ?>