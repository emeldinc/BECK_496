<?php
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$db = new mysqli($servername, $username, $password);
mysqli_set_charset($db,'utf8');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 


?>