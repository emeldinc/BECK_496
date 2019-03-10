<?php
if(session_id() == '')
    session_start();
$duyuru_id = $_GET['id'];
include('dbconnection.php');
if(isset($_POST['submit']))
{
  $description=$_POST['description'];
  if($_POST["title"] == ''){
    $title = '';
  }
  else{
    $title=$_POST["title"];
  }
  if(isset($_POST['check'])){
    $ref_site_id =   $_SESSION['site_id'];
  }
  else{
    $ref_site_id = 0;
  }
  $sql = "SELECT * FROM duyuru ";
  $res = mysqli_query($db,$sql);
  while ($b=mysqli_fetch_array($res)){
    if($duyuru_id == $b['id']){
      $sql2 = "UPDATE duyuru SET ref_site_id='$ref_site_id',now_date=NOW(), title='$title', description='$description' WHERE id=$duyuru_id";
      $res2 = mysqli_query($db,$sql2);
    }
  }
  header('location: duyurular.php');
  }
  else{
    header('location: duyuruduzenle.php');

  }
?>
