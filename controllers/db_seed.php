<?php

require('controllers/dbconn.php'); // Include your database connection file

$username = 'RaziaMunira';
$password = 'admin@!n53cuR3';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the user already exists
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userCount);
$stmt->fetch();
$stmt->close();

if ($userCount == 0) {
    // User does not exist, proceed to insert
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();
    $stmt->close();

    echo "User 'jordan' created successfully with password 'admin'";
} else {
    echo "User 'jordan' already exists";
}

$conn->close();

?>
