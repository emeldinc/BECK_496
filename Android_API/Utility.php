<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-type: application/json; charset=utf-8');

    function getApartmentID($house_id)
    {
        global $db;
        $sql = "SELECT * FROM `daire` WHERE `id` = $house_id";
        $res = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($res);
        return $row['ref_apartman_id'];
    }

    function getHouseNumber($house_id)
    {
        global $db;
        $sql = "SELECT * FROM `daire` WHERE `id` = $house_id";
        $res = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($res);
        return $row['number'];
    }
?>