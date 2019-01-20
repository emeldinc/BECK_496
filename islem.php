<?php
session_start();

if(isset($_POST['username'])){
 $username= $_POST['username'];
 $_SESSION['username'] =$username;
 echo $_SESSION['username'];
 //echo $username;

  if(isset($_POST['beni_hatirla'])){
    //cookie atayalim
    setcookie($_POST['username'],strtotime("+1 day"));
  }else{
    //cookie sil
    setcookie($_POST['username'],strtotime("-1 day"));
  }
  header('location: login.php');

}
else{

  header('location: login.php');

}
?>
