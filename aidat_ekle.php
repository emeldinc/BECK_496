<?php 

	if(session_id() == '')
    session_start();
	include('dbconnection.php');

    $miktar = $_POST['miktar'];
    $daire_id = $_POST['daire'];
    $tarih = $_POST['tarih'];

    $sql = "INSERT INTO beckdoor.aidat (ref_daire_id ,amount, `date`, odendiMi)
    VALUES ('".$daire_id."','".$miktar."','".$tarih."',0)";

    if(mysqli_query($db,$sql)) {
    	header('location: aidat_takip_sayfasi.php');
    }

    else {
        echo $db->error;
        echo "<script> alert('Kaydiniz olusturulamamistir...') </script>";
    }

   



    ?>