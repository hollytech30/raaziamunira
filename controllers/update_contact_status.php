<?php
// Assuming you have a database connection
require('./controllers/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_SESSION['username']) || $_SESSION['username']===''){
        http_response_code(400);
        echo 'Invalid request method';
        exit();
        die();
    }
    $status = $_POST['status'];
    $contactId = $_POST['contactId'];

    // Update the contact status in the database
    $sql = "UPDATE contacts SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $contactId);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Send a success response
    echo 'success';
} else {
    // Invalid request method
    http_response_code(400);
    echo 'Invalid request method';
}
?>
