<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beckdoor";

// Create connection
$db = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($db,'utf8');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 


?>