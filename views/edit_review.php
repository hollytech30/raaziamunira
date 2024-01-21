<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Razia Munira</title>
  <meta name="description" content="Razira Munira is a midwife and nurse offering escort nursing in Uganda and abroad, bedside nursing">
  <meta name="keywords" content="razia, munira, raziamunira, razia_munira, midwife, nurse, escort nursing, Uganda, abroad, bedside nursing">


  <!-- Favicons -->
  <link href="./../assets/img/favicon.png" rel="icon">
  <link href="./../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="./../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="./../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
 
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <?php include('./views/includes/top_bar.php'); ?>

  <!-- ======= Header ======= -->
  <?php include('./views/includes/top_nav_inner.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Edit Review</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Reviews</li>
            <li>Edit</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
            <!-- content -->
            <?php
require('./controllers/dbconn.php');

// Check if the 'rid' parameter is set in the POST request
if (isset($_POST['rid'])) {
    $uuid = $_POST['rid'];

    // Fetch review from the database where uuid matches
    if (!isset($_SESSION['username'])) {
        $result = $conn->query("SELECT user_name, uuid, review_text, review_title FROM reviews WHERE uuid = '$uuid'");
    } else {
        $result = $conn->query("SELECT id, user_name, uuid, review_text,review_title, viewable, created_at, updated_at FROM reviews WHERE uuid = '$uuid'");
    }

    // Check if there is a review with the specified UUID
    if ($result->num_rows > 0) {
        // Output each review and provide a Bootstrap-styled form for editing
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="container mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review by <?php echo $row['user_name']; ?></h5>

                        <form action="/edit_review" method="post" enctype="multipart/form-data">
                            <!-- Include hidden input for review ID -->
                            <input type="hidden" name="review_uuid" value="<?php echo $row['uuid']; ?>">

                            <?php if (isset($_SESSION['username'])) { ?>
                                <!-- Additional fields for logged-in users -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Is visible</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_visible" <?php echo ($row['viewable'] == 1) ? 'checked' : ''; ?>>
                                            <!-- Add a hidden input to represent 'unchecked' value -->
                                            <!-- <input type="hidden" name="is_visible" value="0"> -->
                                            <!-- <label class="form-check-label" for="flexSwitchCheckDefault"> -->
                                                <?php // echo ($row['viewable'] == 1) ? 'yes' : 'no'; ?>
                                            <!-- </label> -->
                                        </div>
                                    </div>
                                </div>
                                                                
                            <?php } ?>
                            <div class="mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $row['user_name'] ?>">
                                </div>
                            <div class="mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $row['review_title'] ?>" placeholder='title'>
                                </div>
                            <div class="mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <input class="form-control" type="file" id="formFile" name="file_upload">
                            </div>
                            <div class="mb-3">
                                <label for="editedReviewText" class="form-label">Your Review:</label>
                                <textarea class="form-control" id="editedReviewText" name="editedReviewText" rows="4" placeholder="content"><?php echo $row['review_text']; ?></textarea>
                            </div>

                            <button type="submit" name="save_review" value="save_review" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "Review not found.";
    }
} else {
    echo "No 'rid' parameter provided.";
}
?>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('./views/includes/bottom_footer.php'); ?>



  <!-- Vendor JS Files -->
  <script src="./../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="./../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="./../assets/js/main.js"></script>

</body>

</html>
