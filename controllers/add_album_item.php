<?php
session_start();

if (isset($_POST["add_album_item"])) {
    // Check if the user is logged in
    if (isset($_SESSION['username']) && $_SESSION['username'] !== "") {
        // Define the folder path to store the uploaded images
        $uploadDirectory = './assets/img/razia_pics/';
        $uploadedFileName = '';
        if ($_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
            $tempName = $_FILES['file_upload']['tmp_name'];
            $originalName = $_FILES['file_upload']['name'];
            $extension = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
            $uploadedFileName = uniqid() . '.' . $extension;
    
            move_uploaded_file($tempName, $uploadDirectory . $uploadedFileName);

            header('location: /');
        } else{
            echo "upload failed";
        }
    

        

    } else {
        // User not logged in
        echo "User not logged in.";
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
