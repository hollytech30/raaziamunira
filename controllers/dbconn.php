<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'raziamunira';

// $dbHost = 'your_db_host';
// $dbUser = 'your_db_user';
// $dbPassword = 'your_db_password';
// $dbName = 'your_db_name';

// Establish a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>