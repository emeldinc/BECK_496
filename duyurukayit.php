<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');
if(isset($_POST['submit']))
{
  $description=$_POST['description'];
  $title=$_POST["title"];
  $username = $_SESSION['username'];
  $ref_user_id =   $_SESSION['user_id'];
  $ref_apartman_id =  $_SESSION['apartman_id'];

  if(isset($_POST['check'])){
    $ref_site_id =   $_SESSION['site_id'];
  }
  else{
    $ref_site_id = 0;
  }

  $sql = "INSERT INTO duyuru (ref_user_id,ref_apartman_id,ref_site_id,now_date,title,description)
  VALUES ('$ref_user_id','$ref_apartman_id','$ref_site_id',NOW(),'".$title."','$description')";
  if(mysqli_query($db,$sql)){

  }
  else {

    echo $db->error;
  }
  header('location: duyurular.php');
  }
  else{
    header('location: duyuruekle.php');


  }

?>
