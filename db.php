<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "license-db";

// Create connection
$db = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>