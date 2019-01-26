<?php
	session_start();
	$idler = explode(",", $_POST['ids']);
	$daire_id = intval($idler[0]);
	$apartman_id = intval($idler[1]);
	$site_id = intval($idler[2]);
    $_SESSION['daire_id'] = $daire_id;
    $_SESSION['apartman_id'] = $apartman_id;
    $_SESSION['site_id'] = $site_id;
	header('location: index.php');

?>