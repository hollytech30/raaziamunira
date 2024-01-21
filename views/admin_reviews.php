<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['username']==""  )
header('location: /admin');
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
 
  ======================================================== -->
</head>

<body>

<?php include ('./views/includes/app_nav.php'); ?>

 
  <main id="main">


    <section class="inner-page">
      <div class="container-fluid px-5">
            <!-- content -->
            <div class="row mb-3">
                <div class="col">
                    <h2>Reviews</h2>
                </div>
                <div class="col text-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newReviewModal">New Review</button>
                </div>
            </div>

            <div class="modal fade" id="newReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">New Review Form</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="card-title">New Review Form</div> -->
                        <form action="/process_new_review" method="POST">
                            <div class="mb-3">
                                <!-- <label for="userName" class="form-label">Name</label> -->
                                <small class="lead">Name of the person / Client to review</small>
                                <input required type="text" placeholder="Type Name here ..." class="form-control" id="userName" name="userName" required>
                            </div>
                            <div class="mb-3 row">
                                <div class="col text-begin">
                                    <button type="submit" class="btn btn-success">create</button>
                                </div>
                                <div class="col text-center">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>

            <div id="review_list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                
                <?php

                    require('./controllers/dbconn.php');
                    // Fetch all reviews from the database
                    $result = $conn->query("SELECT id, user_name, uuid, review_text, viewable, user_image_url, created_at, updated_at FROM reviews ORDER BY created_at DESC ");

                    // Check if there are any reviews
                    if ($result->num_rows > 0) {
                        // Output each review
                        while ($row = $result->fetch_assoc()) {
                            ?>
                             <!-- review item -->
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <img src="assets/img/testimonials/<?php echo $row['user_image_url'] ?>" class="card-img-top" alt="Razia Munira Image">
                                        <div class="card-title d-flex justify-content-between ">
                                            <b><?php echo $row['user_name'] ; ?></b>
                                            <small class="text-body-secondary">
                                                <?php echo $row['created_at'] ; ?>
                                            </small>
                                        </div>
                                        <p class="card-text">
                                            <?php echo $row['review_text'] ; ?>
                                        </p>
                                        <p>Link: 
                                            <code class="code" id="linkCode<?php echo $row['id'] ; ?>"><?php echo $_SERVER['HTTP_HOST']."/r/".$row['uuid'] ; ?></code>
                                            <span type="button" class="badge bg-secondary" onclick="copyToClipboard(<?php echo $row['id'] ; ?>)">
                                                <i class="bi bi-files me-1"></i>Copy
                                            </span>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Details</button> -->
                                                <button type="button" class="btn  btn-link btn-sm btn-outline-secondary">
                                                    <a href="/r/<?php echo $row['uuid'] ; ?>">Edit</a>
                                                </button>
                                                <!-- <button type="button" class="btn">Link</button> -->
                                            </div>
                                            <div>
                                            <span class="badge bg-<?php echo ($row['viewable'] ? "info" : "warning"); ?> text-dark">
                                                <?php echo ($row['viewable'] ? "Public" : "Private"); ?>
                                            </span>

                                            </div>
                                            <small class="text-body-secondary">
                                                <?php echo $row['updated_at'] ; ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end review item -->
                            <?php
                        }
                    } else {
                        echo "<p>No review found</p>" ;
                    }

                
                ?>
                
                <script>
        function copyToClipboard(id) {
            // Get the text content from the code element
            var linkCode = document.getElementById("linkCode"+id);

            // Create a temporary input element
            var tempInput = document.createElement("input");
            tempInput.value = linkCode.innerText;

            // Append the input element to the body
            document.body.appendChild(tempInput);

            // Select the text in the input element
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Provide feedback to the user (you can customize this part)
            alert("Link copied to clipboard: " + linkCode.innerText);
        }
    </script>
               
            </div>

   
            
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('./views/includes/bottom_footer.php'); ?>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
