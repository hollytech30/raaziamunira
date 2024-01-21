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

  <!-- add jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <!-- =======================================================
 
  ======================================================== -->
</head>

<body>

<?php include ('./views/includes/app_nav.php'); ?>

 
  <main id="main">

  <?php
// Assuming you have a database connection
require('./controllers/dbconn.php');

// Fetch contacts from the database
$sql = "SELECT * FROM contacts ORDER BY created_at DESC ;";
$result = $conn->query($sql);

$contacts = [];

if ($result->num_rows > 0) {
   
?>


    <section class="inner-page">
      <div class="container">
        
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contacts</h5>

              <div class="accordion accordion-flush" id="faq-group-1">
<?php

while ($row = $result->fetch_assoc()) {
    // $contacts[] = $row;
    ?>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" data-bs-target="#faqsOne-<?php echo $row['id'] ?>" type="button" data-bs-toggle="collapse" aria-expanded="false">
                <?php echo $row['subject'] ." --> ". $row['email'] ." --> ". $row['name']." --> ". $row['created_at'] ?>
                <?php
                    if($row['status']=="unread")
                        echo '&nbsp;<span id="badge-'.$row['id'].'" class="badge rounded-pill bg-info">Unread</span>';
                    if($row['status']=="read")
                        echo '&nbsp;<span id="badge-'.$row['id'].'" class="badge rounded-pill bg-success">Read</span>';
                    if($row['status']=="responded_to")
                        echo '&nbsp;<span id="badge-'.$row['id'].'" class="badge rounded-pill bg-secondary">Replied</span>';
                ?>
            </button>
        </h2>
        <div id="faqsOne-<?php echo $row['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#faq-group-1" style="">
            <div class="accordion-body">
                <div class="mx-5">
                    <div class="btn-group" role="group" aria-label="contact Options">
                        <button type="button" onclick="markas('read','<?php echo $row['id'] ?>')" class="btn btn-sm btn-outline-primary">Mark as read</button>
                        <button type="button" onclick="markas('responded_to','<?php echo $row['id'] ?>')" class="btn btn-sm btn-outline-primary">Mark as replied to</button>
                    </div>
                    <p >
                        <?php echo $row['message'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
                
<?php

}

?>
  </div>

</div>
</div>

</div>
</section>
<?php
}

$conn->close();

?>
                
                
<script>
    function markas(status, contactId) {
        // Assuming you have jQuery included in your project

        // Send an AJAX request to update the contact status
        $.ajax({
            type: 'POST',
            url: '/update_contact_status', // Replace with the actual URL for your update_contact_status.php file
            data: {
                status: status,
                contactId: contactId
            },
            success: function(response) {
                // Update the UI based on the response from the server
                if (response === 'success') {
                    // Update the badge and any other UI elements accordingly
                    var badgeElement = document.getElementById('badge-' + contactId);
                    if (badgeElement) {
                        if (status === 'read') {
                            badgeElement.innerHTML = '<span class="badge rounded-pill bg-success">Read</span>';
                        } else if (status === 'responded_to') {
                            badgeElement.innerHTML = '<span class="badge rounded-pill bg-secondary">Replied</span>';
                        }
                    }
                } else {
                    alert('Failed to update contact status. Please try again.');
                    alert(response);
                }
            },
            error: function() {
                alert('Error while processing the request. Please try again.');
            }
        });
    }
</script>


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
