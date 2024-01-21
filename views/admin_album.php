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
      <div class="container">
        <div class="row">
          <div class="col">
            <h2>Admin Album</h2>
          </div>
          <!-- Add this button wherever you need it -->
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAlbumModal">
                    Create New Album
                </button>
            </div>

            <!-- The modal structure -->
<div class="modal fade" id="createAlbumModal" tabindex="-1" aria-labelledby="createAlbumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAlbumModalLabel">Create New Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/add_album_item" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <input class="form-control" type="file" id="formFile" name="file_upload">
                </div>
                <button type="submit" name="add_album_item" value="accept" class="btn btn-primary">Add</button>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Add a button to submit the form or trigger the necessary action -->
                <!-- <button type="button" class="btn btn-primary" id="createAlbumBtn">Create Album</button> -->
            </div>
        </div>
    </div>
</div>


        </div>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-lg-3 g-3">
              <!-- album item -->
              <?php
              $folderPath = './assets/img/razia_pics/';
              $imageFiles = scandir($folderPath);
              $allowed_extensions = array('jpg', 'jpeg', 'png');

              for ($i = 0; $i < 12 && $i < count($imageFiles); $i++) {
                  if (!in_array(strtolower(pathinfo($imageFiles[$i])['extension']), $allowed_extensions)) {
                      continue;
                  }
                  $imagePath = $folderPath . $imageFiles[$i];
                  ?>
                  <div class="col">
                      <div class="p-2"  style="border: 2px solid green;">
                          <img src="<?php echo $imagePath; ?>" style="height:200px; width:100%" alt="Munira-gallery">
                          <div class="gallery-options d-flex align-items-center justify-content-between mt-2">
                              <!-- Delete Button -->
                              <form method="post" action="/delete_image">
                                  <input type="hidden" name="image_path" value="<?php echo $imagePath; ?>">
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                              <!-- Rename Button -->
                              <!-- <form method="post" action="rename_image.php">
                                  <input type="hidden" name="old_image_path" value="<?php echo $imagePath; ?>">
                                  <input type="text" name="new_image_name" placeholder="New Name">
                                  <button type="submit" class="btn btn-primary btn-sm">Rename</button>
                              </form> -->
                          </div>
                      </div>
                  </div>
                  <?php
              }
              ?>
              <!-- end album item -->
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
