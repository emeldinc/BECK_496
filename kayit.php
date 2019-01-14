<?php
include('dbconnection.php');

$value = $_POST;
$sql = "INSERT INTO beckdoor.user (username, firstname, lastname, role)
VALUES ('".$value['username']."', '".$value['firstname']."', '".$value['lastname']."', '".$value['role']."')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();


?>