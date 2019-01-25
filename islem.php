<?php
include('dbconnection.php');
if(session_id() =='')
  session_start();

if(isset($_POST['username'])){
    $username= $_POST['username'];

    //echo $username;
    $sorgu = "SELECT * FROM beckdoor.user WHERE beckdoor.user.username = '".$username."'";
    $res = mysqli_query($db,$sorgu);
  //  echo mysqli_error($db);
   if(mysqli_affected_rows($db) >= 1){
      $_SESSION['username'] =$username;
      
      //echo $_SESSION['username'];
    }

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
