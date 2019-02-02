<?php 

	if(session_id() == '')
    session_start();
	include('dbconnection.php');

    $miktar = $_POST['miktar'];
    $tarih = $_POST['tarih'];
    $aidat_id = $_GET['aidat_id'];

    $sql = "UPDATE beckdoor.aidat SET amount = '".$miktar."', date = '".$tarih."'
    WHERE id = '".$aidat_id."'";

    if(mysqli_query($db,$sql)) {
    	header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }

   



    ?>