<?php
include('dbconnection.php');

$value = $_POST;

$sql_for_daire = "INSERT INTO beckdoor.daire (ref_apartman_id,`number`)
VALUES ('".$value['apartman_id']."','".$value['numara']."')";

if ($db->query($sql_for_daire) === TRUE) {
    echo "apartman daire ve site kayıtları oluşturuldu.......";
    $insert_id = $db->insert_id;
    
    //$user_id = $_SESSION["id"];
    /*$sql_for_user_daire = "INSERT INTO beckdoor.user_daire (ref_user_id, ref_daire_id)
    VALUES ('".$user_id."','".$insert_id."')";
    $db->query($sql_for_user_daire);*/

} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>