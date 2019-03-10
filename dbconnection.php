<?php
$servername = "localhost";
$username = "u413882592_root";
$password = "beckdoor123";
$dbname = "u413882592_beckd";

// Create connection
$db = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($db,'utf8');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 


?>