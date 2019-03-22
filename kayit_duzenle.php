<?php
if(session_id() == '')
    session_start();

include('dbconnection.php');
if(isset($_POST['submit']))
{
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $username=$_POST['username'];
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM `user` ";
  $res = mysqli_query($db,$sql);
  while ($b=mysqli_fetch_array($res)){
    if($user_id == $b['id']){
      $sql2 = "UPDATE `user` SET firstname='$firstname',lastname='$lastname',username='$username'  WHERE id=$user_id";
      $res2 = mysqli_query($db,$sql2);
      $_SESSION['username'] = $username;
      $_SESSION['firstname'] = $firstname;
      $_SESSION['lastname'] = $lastname;
    }
  }
  header('location: profil.php');
  }
  else{
    header('location: profil.php');

  }
?>
