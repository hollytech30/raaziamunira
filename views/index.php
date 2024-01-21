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
  <link href="assets/img/favicon.svg" rel="icon" type="image/svg+xml">
  <link href="assets/img/apple-touch-icon.svg" rel="apple-touch-icon" type="image/svg+xml">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- styles -->
  <?php
    require('./views/includes/styles.php');
  ?>

</head>

<body>

<!-- top bar -->
<?php
    require('./views/includes/top_bar.php');
  ?>
<?php
    require('./views/includes/top_nav.php');
  ?>

   <!-- main content -->
   <section id="heror" class="d-flex align-items-center">
    <!-- <div class="container"> -->
        <div class="container-fluid col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6" style="background-image: url('./../assets/img/razia_pics/IMG_0083.jpg'); min-height: 80vh; background-size: cover;" loading="lazy">
                <!-- &nbsp; -->
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Your Health is My Priority…</h1>
                <p class="lead">I am leading home care service provider in Uganda supervising a highly effective staff of professional medical practitioners & associates. I offer a wide range of services, programs, and health plans to meet the diverse needs of our patients, members, and clients.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">More about me</button>
                </div>
            </div>
            </div>
        </div>
    <!-- </div> -->
  </section><!-- End Hero -->
  <div class="container" >
    <!-- about me-->
    <div class="row mb-3 text-center" id="about">
    <!-- <hr class="border border-danger border-2 opacity-50"> -->

    <div class="section-title">
        <h2>Who is Razia Munira?</h2>
    </div>
        <div class="col-md-4 themed-grid-col" 
            style="background-image: url('./../assets/img/razia_pics/IMG_0083.jpg'); background-size: cover;">
        </div>
        <div class="col-md-8 themed-grid-col">
            <div class="pb-3">
                <h3  class="lead">My personal commitment to medical excellence.</h3>
            </div>
            <div class="row">
                <div class="col-md-6 themed-grid-col">
                    <p>Since 2021, I been unwaveringly committed to providing exceptional home health care to individuals in need.</p>
                    <p>My journey began when I witnessed the challenges patients faced in finding reliable and affordable home care. Motivated by personal experiences, I started to offer bedside nursing in 2022.</p>
                </div>
                <div class="col-md-6 themed-grid-col">
                    <p>Over the years, my expertise has grown, and I have assisted numerous seniors and home-based patients in accessing quality health care with respect and dignity.</p>
                    <p>Today, I remain focused on promoting the health and well-being of patients and their families.I provide expert and cost-effective care directly in the comfort of patients' homes and communities.</p>
                </div>
            </div>
        </div>        
    </div><!-- end about me-->
    <!-- my services -->
    <div class="container" id="services">

        <div class=" row mb-3">
            <!-- <hr class="border border-danger border-2 opacity-50"> -->

            <div class="section-title">
                <h2>My Expertise</h2>
            </div>
            
            <div class="col-md-8 themed-grid-col">
                <div class="pb-3">
                    <h3 class="lead  text-center">Services I offer.</h3>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <?php
                            $services = array(
                                'First Aid Management' => 'We don’t expect accidents to happen, but when they do, are you confident that your first aid kit is adequately stocked to treat injuries at work, home, or public event? Let’s help',
                                'Bedside Care' => 'Providing personalized and compassionate care at the bedside to ensure the well-being and comfort of patients.',
                                'Escort Nurse (In Uganda and Abroad)' => 'Accompanying and assisting patients during medical appointments, travel, and healthcare services, both within Uganda and internationally.',
                                // 'Domiciliaries' => 'Delivering healthcare services and support in the comfort of the patient\'s home, ensuring a familiar and conducive environment.',            
                                'Post-Surgery Care' => 'Assisting patients in their recovery process after surgery, ensuring proper wound care and monitoring for any complications.',
                            );

                            $count = count($services);

                            for ($i = 0; $i < $count; $i += 1) {
                                ?>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h3 class="m-2"><i class="bi bi-plus-circle"></i></h3>
                                        <h3><?= key($services) ?></h3>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h3 style="visibility:hidden;" class="m-2"><i class="bi bi-plus-circle"></i></h3>
                                        <p><?= current($services) ?></p>
                                    </div>
                                </div>
                            <?php
                                if ($i + 1 < $count) {
                                    next($services); // move pointer only if there's another set of services
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div> 
            <div class="col-md-4 themed-grid-col" 
                style="background-image: url('./../assets/img/razia_pics/IMG_0083.jpg'); background-size: cover;">
            </div>       
        </div>
    </div><!-- end services-->

<!-- =====testimonials===== -->

<?php
// Assuming you have already connected to the database using dbconn.php
require('./controllers/dbconn.php');

// Fetch reviews from the database
$result = $conn->query("SELECT user_name, review_title, review_text, user_image_url FROM reviews WHERE viewable = 1 ORDER BY created_at DESC");

// Check if there are any reviews
if ($result->num_rows > 0) {
    echo '<section id="testimonials" class="testimonials">
            <div class="section-title">
                <h2>Testimonials</h2>
                <p class="lead">What others say about me.</p>
            </div>
            <div class="container">
              <div class="testimonials-slider swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">';

    // Output each review
    while ($row = $result->fetch_assoc()) {
        echo '<div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <!-- Assuming you have an image field in your database, replace "user_image_url" with the actual field name -->
                    <img src="assets/img/testimonials/'.($row['user_image_url'] ? $row['user_image_url'] : 'default-image.jpg').'" class="testimonial-img" alt="">
                    <h3>' . $row['user_name'] . '</h3>
                    <h4>' . $row['review_title'] . '</h4>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      ' . $row['review_text'] . '
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>';
    }

    echo '</div>
          <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
      </div>
    </section>';

} else {
    echo 'No reviews available.';
}

// Close the database connection
$conn->close();
?>

<?php
    require('./views/includes/contact_form.php');
?>




<div class="container-fluid" id="gallery">
    <div class="section-title">
        <h2>Munira at Work</h2>
    </div>
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
        <?php
            $folderPath = './assets/img/razia_pics/';
            $imageFiles = scandir($folderPath);
            // echo "<pre>";
            // var_dump($imageFiles);
            // echo "</pre>";
            // die();
            $allowed_extensions = array ('jpg','jpeg','png');

            for ($i = 0; $i < 12 && $i < count($imageFiles); $i++) {
                if(!in_array(strtolower(pathinfo($imageFiles[$i])['extension']),$allowed_extensions)){
                    continue ;
                }
                $imagePath = $folderPath . $imageFiles[$i];
                
                ?>
                <div class="col">
                    <div class="p-2"  style="border: 2px solid green;">
                        <!-- <img src="<?php echo $imagePath; ?>" style="height:200px; width:100%" alt="Munira-gallery" > -->
                        <!-- <div class="gallery-links d-flex align-items-center justify-content-center"> -->
                <a href="<?php echo $imagePath; ?>" title="<?php echo $imageFiles[$i]; ?>" class="glightbox preview-link">
                <img src="<?php echo $imagePath; ?>" style="height:200px; width:100%" alt="Munira-gallery" >
            </i></a>
                <!-- <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
              <!-- </div> -->
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>
        
  </div>
  <!-- end main content -->

<!-- footer -->
<?php
    require('./views/includes/bottom_footer.php');
  ?>
<!-- js -->
<?php
    require('./views/includes/scripts.php');
  ?>
</body>

</html>