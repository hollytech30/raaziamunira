<?php

// $dbHost = 'localhost';
// $dbUser = 'root';
// $dbPassword = '';
// $dbName = 'raziamunira';

$dbHost = 'sql213.infinityfree.com';
$dbUser = 'if0_35799655';
$dbPassword = 'gquowvE8VE2C';
$dbName = 'if0_35799655_raziamunira';

// Establish a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>