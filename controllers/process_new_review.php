<?php
session_start();

// var_dump($_POST); die();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('controllers/dbconn.php');

    if (isset($_POST['userName']) && isset($_SESSION['username']) &&  $_SESSION['username'] !== '') {
        // echo $_POST['userName'];
        // Sanitize and validate the input data before using it in the SQL query
        $userName = htmlspecialchars($_POST['userName'], ENT_QUOTES, 'UTF-8');

        // Generate a UUID
        // $uuid = uniqid();

        $stmt = $conn->prepare("INSERT INTO reviews (user_name, uuid) VALUES (?, uuid())");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->close();

        header("location: /reviews");

    } else {
        echo "name is required";
    }
} else {
    echo "Not a POST request";
}
?>
