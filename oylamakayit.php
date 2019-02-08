<?php
        include 'dbconnection.php';
        if(session_id() == '')
            session_start();
        $user = $_SESSION['user_id'];
        $apartman = $_SESSION['site_id'];
        $site = $_SESSION['apartman_id'];
        $title = $_POST['title'];
        $options = $_POST['options'];

        $options = explode(',', $options);
        var_dump($options);

        $description = $_POST['description'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $startdate = date('Y-m-d',strtotime($startdate));
        $enddate = date('Y-m-d',strtotime($enddate));

        if(strtotime($startdate) >= strtotime($enddate) )
        {
            echo "<script> confirm('Başlangıç Tarihi Bitiş Tarihinden Büyük olamaz...') </script>";

            //header("location: yeni_oylama.php");
        }
         $sql = "INSERT INTO `oylama`(`ref_user_id`,`ref_apartman_id`, `ref_site_id`, `title`, `description`, `start_date`, `end_date`) VALUES ($user,$apartman,$site,'$title','$description','$startdate','$enddate')";


        if(mysqli_query($db,$sql))
        {
            header("location: oylamalar.php");
            $insert = $db -> insert_id;
            foreach ($options as $option)
            {
                $sql = "INSERT INTO `oy_tipi` (`ref_oylama_id`,`description`) VALUES ($insert,$option)";
                mysqli_query($db,$sql);
            }
        }
        else
            echo $db->error;


?>