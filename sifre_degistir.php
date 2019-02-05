<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');
if(isset($_POST['submit']))
{
  $password = substr(md5($_POST['password']),0,30);
  $new_password = substr(md5($_POST['new_password']),0,30);
  $user_id = $_SESSION['user_id'];

  $sql = "SELECT * FROM user ";
  $res = mysqli_query($db,$sql);
  while ($b=mysqli_fetch_array($res)){
    if($user_id == $b['id']){
        if($password==$b['password']){
          $sql2 = "UPDATE beckdoor.user SET password='$new_password'  WHERE id=$user_id";
          $res2 = mysqli_query($db,$sql2);
            header('location: profil.php');

        }
    }
    else {
        echo $db->error;
        echo "<script> alert('Varolan sifreyi yanlis girdiniz...') </script>";

    }
  }
}
?>
