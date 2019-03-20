<?php
    include '../dbconnection.php';
    if(isset($_POST['duyuru']))
    {
        $response = array("error" => FALSE,"duyurular" => array());
        $apartman_id = $_POST['duyuru'];
        $sql = "SELECT * FROM `duyuru` WHERE `ref_apartman_id` = $apartman_id";
        $res = mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($res))
        {
            $duyuru = array();
            $namesql = "SELECT * FROM `user` WHERE `id` = ".$row['ref_user_id'];
            $innerres = mysqli_query($db,$innerres);
            $innerrow = mysqli_fetch_assoc($innerres);
            $duyuru['fullname'] = $innerrow['firstname']." ".$innerrow['lastname'];
            $duyuru['title'] = $row['title'];
            $duyuru['description'] = $row['description'];
            $duyuru['date'] = $row['now_date'];
            array_push($response['duyurular'],$duyuru);
        }
        echo json_encode($response);
    }

?>