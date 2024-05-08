<?php
$host="127.0.0.1:8889"; // Host IP
$db_username="root"; // Mysql username (your student number)
$db_password="root"; // Mysql password (look for it on E-Commerce Brightspace)
$db_name="KIKFAV"; // Database name (look for it on E-Commerce Brightspace)

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};
?>
