<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-type: application/json; charset=utf-8');

    include ('../dbconnection.php');

    $response = array("error" => FALSE,"oylamalar" => array());
    $apartman_id = $_GET['oylama'];
    $sql = "SELECT * FROM `oylama` WHERE `ref_apartman_id` = $apartman_id";
    $res = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($res))
    {
        $oylamalar = array();
        $sql = "SELECT * FROM `user` WHERE `id` = ".$row['ref_user_id'];

        $innerres = mysqli_query($db,$sql);
        $innerrow = mysqli_fetch_assoc($innerres);

        $oylamalar['fullname'] = $innerrow['firstname']." ".$innerrow['lastname'];
        $oylamalar['title'] = $row['title'];
        $oylamalar['description'] = $row['description'];
        $oylamalar['start_date'] = $row['start_date'];
        $oylamalar['end_date'] = $row['end_date'];
        $oylamalar['options'] = array();

        $sql = "SELECT * FROM `oy_tipi` WHERE `ref_oylama_id` = ".$row['id'];
        $innerres = mysqli_query($db,$sql);

        $toplam = 0;
        while($innerrow = mysqli_fetch_assoc($innerres))
        {
            $oysayisisql = "SELECT * FROM `oy` WHERE ref_oy_tipi_id = ".$innerrow['id'];
            $oysayisires = mysqli_query($db,$oysayisisql);
            $toplamoy = mysqli_affected_rows($db);
            array_push($oylamalar['options'],$innerrow['description'] . " ".$toplamoy);
            $toplam += $toplamoy;
        }
        $oylamalar['votes'] = $toplam;
        array_push($response['oylamalar'],$oylamalar);
    }
    echo json_encode($response);

    /*
        $sql_oysayisi = "SELECT * FROM `oy` WHERE ref_oylama_id = ".$row['id'];
        mysqli_query($db,$sql_oysayisi);
        $toplamoy = mysqli_affected_rows($db);
    */

?>