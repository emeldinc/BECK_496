<?php 
	include("dbconnection.php");
	session_start();
	$sender = $_GET['sender'];
	$date = $_GET['date'];
	$datetime = date('Y-m-d H:i:s',strtotime($date));
	$content = $_GET['content'];
	$apartman_id = $_SESSION['apartman_id'];
	$site_id = $_SESSION['site_id'];
	$user_id = $_SESSION['user_id'];
	$sql = "INSERT INTO mesaj (`date`,sender,username,content,ref_apartman_id,ref_site_id)
			VALUES ('".$datetime."','".$user_id."','".$sender."','".$content."','".$apartman_id."','".$site_id."')";
	if (mysqli_query($db,$sql)) {} 
	else {
	    echo $db->error;
	}
	
?>