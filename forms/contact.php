<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate and sanitize input (you might want to add more validation)
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Insert data into the database (replace this with your database connection logic)
    require('./../controllers/dbconn.php');

    // Assuming you have a table named 'contacts' with columns 'name', 'email', 'subject', 'message'
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        // Success: Redirect or send a success message
        header("Location: /"); // Redirect to a thank-you page
        exit();
    } else {
        // Error: Redirect or display an error message
        header("Location: /error-page"); // Redirect to an error page
        exit();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
