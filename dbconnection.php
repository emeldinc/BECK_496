<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$db = new mysqli($servername, $username, $password);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>
