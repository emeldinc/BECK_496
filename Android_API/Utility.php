<?php

    function getApartmentID($house_id)
    {
        global $db;
        $sql = "SELECT * FROM `daire` WHERE `id` = $house_id";
        $res = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($res);
        return $row['ref_apartman_id'];
    }
?>