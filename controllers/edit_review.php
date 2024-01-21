<?php
session_start();

if ($_POST["save_review"] == "save_review") {
    require('./controllers/dbconn.php');

    // Sanitize and validate the input data before using it in the SQL query
    $reviewUUID = htmlspecialchars($_POST['review_uuid'], ENT_QUOTES, 'UTF-8');
    $fullName = isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8') : '';
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8') : '';
    $editedReviewText = htmlspecialchars($_POST['editedReviewText'], ENT_QUOTES, 'UTF-8');
    $is_visible = isset($_POST['is_visible']) ? ($_POST['is_visible'] == 'on' ? 1 : 0) : 0;

    // Handle File Upload - Make sure to implement file handling logic based on your requirements
    $uploadDirectory = './assets/img/testimonials/';
    $uploadedFileName = '';
    if ($_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['file_upload']['tmp_name'];
        $originalName = $_FILES['file_upload']['name'];
        $extension = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
        $uploadedFileName = uniqid('testimonial_') . '.' . $extension;

        move_uploaded_file($tempName, $uploadDirectory . $uploadedFileName);
    }

    // Update the review in the database
    $stmt = $conn->prepare("UPDATE reviews SET uuid = uuid() , user_name = ?, review_title = ?, review_text = ?, user_image_url = ?, viewable = ? WHERE uuid = ?");
    $stmt->bind_param("ssssds", $fullName, $title, $editedReviewText, $uploadedFileName, $is_visible, $reviewUUID);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect to the page where the review was edited (you may change the URL accordingly)
    if(isset($_SESSION['username'])){
        header("Location: /reviews");
    }else{
        header("Location: /");
    }
    exit();
} else {
    echo "Not a POST request";
}
?>
