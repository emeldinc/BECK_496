<?php
include('dbconnection.php');

$value = $_POST;

$sql_for_daire = "INSERT INTO daire (ref_apartman_id,`number`)
VALUES ('".$value['apartman_id']."','".$value['numara']."')";

if ($db->query($sql_for_daire) === TRUE) {
    
    $insert_id = $db->insert_id;
	session_start();
    $user_id = $_SESSION["user_id"];
    $sql_for_user_daire = "INSERT INTO user_daire (ref_user_id, ref_daire_id)
    VALUES ('".$user_id."','".$insert_id."')";
    $db->query($sql_for_user_daire);
    header('location: index.php');

} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>