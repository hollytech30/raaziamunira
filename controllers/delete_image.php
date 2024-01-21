<?php
session_start();

// Check if the user is logged in and the session is not empty
if (isset($_SESSION['username']) && $_SESSION['username'] !== "") {
    // Assuming you have a database connection established
    require_once('./controllers/dbconn.php');

    // Assuming you have a table named 'users' in your database
    $username = $_SESSION['username'];

    // Prepare a SQL statement to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($result->num_rows > 0) {
        // User exists, proceed with deleting the image
        $imagePath = $_POST['image_path'];

        // Perform validation or additional checks if needed

        // Delete the image
        unlink($imagePath);

        // Redirect back to the admin page
        header("Location: /album");
        exit();
    } else {
        // User does not exist in the database, handle accordingly (e.g., show an error message)
        echo "Error: User not found in the database.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the login page or handle accordingly if the user is not logged in
    header("Location: admin.php");
    exit();
}
?>
