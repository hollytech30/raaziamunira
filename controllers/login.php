<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('controllers/dbconn.php');

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);

        $username = $_POST['username'];
        $stmt->execute();

        $stmt->bind_result($dbUsername, $dbUserPassword);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if (!empty($dbUsername) && password_verify($_POST['password'], $dbUserPassword)) {
            $_SESSION['username'] = $dbUsername;
            header("Location: /dashboard");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Username and password are required";
    }
} else {
    echo "Not a POST request";
}
?>
