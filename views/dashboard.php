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


  <?php
// Assuming you have a function to fetch the review statistics from the database
// Modify this function based on your database schema and structure
function getReviewStatistics() {
    require('./controllers/dbconn.php');

    // Fetch public reviews count
    $publicReviewsCountResult = $conn->query("SELECT COUNT(*) as count FROM reviews WHERE viewable = 1");
    $publicReviewsCount = ($publicReviewsCountResult->num_rows > 0) ? $publicReviewsCountResult->fetch_assoc()['count'] : 0;

    // Fetch private reviews count
    $privateReviewsCountResult = $conn->query("SELECT COUNT(*) as count FROM reviews WHERE viewable = 0");
    $privateReviewsCount = ($privateReviewsCountResult->num_rows > 0) ? $privateReviewsCountResult->fetch_assoc()['count'] : 0;

    // Fetch total reviews count
    $totalReviewsCountResult = $conn->query("SELECT COUNT(*) as count FROM reviews");
    $totalReviewsCount = ($totalReviewsCountResult->num_rows > 0) ? $totalReviewsCountResult->fetch_assoc()['count'] : 0;

    // Fetch total contacts count
    $totalContactsCountResult = $conn->query("SELECT COUNT(*) as count FROM contacts");
    $totalContactsCount = ($totalContactsCountResult->num_rows > 0) ? $totalContactsCountResult->fetch_assoc()['count'] : 0;

     // Fetch read contacts count
     $readContactsCountResult = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status = 'read'");
     $readContactsCount = ($readContactsCountResult->num_rows > 0) ? $readContactsCountResult->fetch_assoc()['count'] : 0;
 
     // Fetch unread contacts count
     $unreadContactsCountResult = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status = 'unread'");
     $unreadContactsCount = ($unreadContactsCountResult->num_rows > 0) ? $unreadContactsCountResult->fetch_assoc()['count'] : 0;

      // Fetch replied contacts count
      $repliedtoContactsCountResult = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status = 'responded_to'");
      $repliedtoContactsCount = ($repliedtoContactsCountResult->num_rows > 0) ? $repliedtoContactsCountResult->fetch_assoc()['count'] : 0;

    // Close the database connection
    $conn->close();

    return [
        'publicReviewsCount' => $publicReviewsCount,
        'privateReviewsCount' => $privateReviewsCount,
        'totalReviewsCount' => $totalReviewsCount,
        'totalContactsCount'=>$totalContactsCount,
        'readContactsCount'=>$readContactsCount,
        'unreadContactsCount'=>$unreadContactsCount,
        'repliedtoContactsCount'=>$repliedtoContactsCount,
    ];
}

// Get the review statistics
$reviewStatistics = getReviewStatistics();
?>

<section class="inner-page">
    <div class="container">
        <!-- content -->
        <h2>Dashboard</h2>
        Welcome back <?php echo $_SESSION['username'] ?>
        <div class="row mt-4">
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Public Reviews</h5>
                        <p class="card-text"><?php echo $reviewStatistics['publicReviewsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Private Reviews</h5>
                        <p class="card-text"><?php echo $reviewStatistics['privateReviewsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Reviews</h5>
                        <p class="card-text"><?php echo $reviewStatistics['totalReviewsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total total Contacts Count</h5>
                        <p class="card-text"><?php echo $reviewStatistics['totalContactsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total read Contacts Count</h5>
                        <p class="card-text"><?php echo $reviewStatistics['readContactsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total unread Contacts Count</h5>
                        <p class="card-text"><?php echo $reviewStatistics['unreadContactsCount']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total replied to Contacts Count</h5>
                        <p class="card-text"><?php echo $reviewStatistics['repliedtoContactsCount']; ?></p>
                    </div>
                </div>
            </div>
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
