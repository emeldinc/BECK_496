<?php
$duyuru_id = $_GET['id'];
include('dbconnection.php');
if ($_POST['confirm'] !== 1) {
  $sql = "SELECT * FROM duyuru ";
  $res = mysqli_query($db,$sql);
  while ($b=mysqli_fetch_array($res)){
    if($duyuru_id == $b['id']){
      $sql2 = "DELETE FROM beckdoor.duyuru WHERE id=$duyuru_id";
      $res2 = mysqli_query($db,$sql2);
    }
  }
  header('location: duyurular.php');
}


?>
