<?php
if(session_id() == '')
    session_start();
include('dbconnection.php');
if(isset($_POST['submit']))
{
  if($_FILES["resim"]["size"] < 1024*1024){ // 1mb dan kucukse isleme devam et
    if($_FILES["resim"]["type"] == "image/jpeg"){
      $file_name=$_SESSION['user_id'].".jpeg"; //ayni isimde resimler olmamasi icin resmin adi kullanicinin idsi olsun. id.jpeg
      $file_path="assets/images/".$file_name;
      $user_id=$_SESSION['user_id'];
      if(move_uploaded_file($_FILES["resim"]["tmp_name"], $file_path)){
        $sql = "SELECT * FROM user ";
        $res = mysqli_query($db,$sql);
        while ($b=mysqli_fetch_array($res)){
          if($user_id == $b['id']){
            $sql2 = "UPDATE user SET image_path='$file_path' WHERE id=$user_id";
            $res2 = mysqli_query($db,$sql2);
            $_SESSION['image_path'] = $file_path;
          }
        }
        header('location: profil.php');

      }
      else{
        header('location: profil.php');
      }

    }
    else{
      echo "<script> alert('Resim eklenemedi. jpeg formatinda olmali.') </script>";

    }
  }
  else{
    echo "<script> alert('Resim eklenemedi. 1MB'dan kucuk olmali') </script>";

  }
}

 ?>
