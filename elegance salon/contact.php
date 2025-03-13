<?php
session_start(); // Start session for message handling
include_once('includes/dbconnection.php'); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $query = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($con, $query)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Message sent successfully!</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Failed to send message. Please try again.</div>";
    }

    header("Location: contact.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BPMS - Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        html, body {
            overflow-x: hidden;
            width: 100%;
        }
        .container {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
  </head>
  <body>
    <?php include_once('includes/header.php'); ?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
          <div class="col-md-9 text-center pb-5">
            <h2 class="mb-0 bread">Contact Us</h2>
            <p class="breadcrumbs"><span><a href="index.php">Home</a> <i class="ion-ios-arrow-forward"></i></span> <span>Contact</span></p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="contact-section bg-light">
      <div class="container">
        <div class="row d-flex contact-info">
          <?php
            $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
            while ($row = mysqli_fetch_array($ret)) {
          ?>
          <div class="col-md-3 text-center">
            <div class="box p-4 py-md-5">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-map-signs"></span>
              </div>
              <h3>Address</h3>
              <p><?php echo $row['PageDescription']; ?></p>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="box p-4 py-md-5">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-phone2"></span>
              </div>
              <h3>Contact Number</h3>
              <p><a href="tel:<?php echo $row['MobileNumber']; ?>">+ <?php echo $row['MobileNumber']; ?></a></p>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="box p-4 py-md-5">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-paper-plane"></span>
              </div>
              <h3>Email Address</h3>
              <p><a href="mailto:<?php echo $row['Email']; ?>"><?php echo $row['Email']; ?></a></p>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="box p-4 py-md-5">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-globe"></span>
              </div>
              <h3>Timing</h3>
              <p><?php echo $row['Timing']; ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    
    <div class="container mt-5">
      <h2>Get In Touch</h2>
      <?php
        if (isset($_SESSION['msg'])) {
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        }
      ?>
      <form action="contact.php" method="post">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="form-group">
          <input type="text" name="subject" class="form-control" placeholder="Subject" required>
        </div>
        <div class="form-group">
          <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>
    
    <div class="container mt-5">
      <h2>Find Us on Google Map</h2>
      <div id="map" style="width: 100%; height: 400px;"></div>
    </div>
    
    <?php include_once('includes/footer.php'); ?>
    
    <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
