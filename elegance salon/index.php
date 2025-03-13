<?php 
include('includes/dbconnection.php');
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {

    $name=$_POST['name'];
    $email=$_POST['email'];
    $services=$_POST['services'];
    $adate=$_POST['adate'];
    $atime=$_POST['atime'];
    $phone=$_POST['phone'];
    $aptnumber = mt_rand(100000000, 999999999);
  
    $query=mysqli_query($con,"insert into tblappointment(AptNumber,Name,Email,PhoneNumber,AptDate,AptTime,Services) value('$aptnumber','$name','$email','$phone','$adate','$atime','$services')");
    if ($query) {
$ret=mysqli_query($con,"select AptNumber from tblappointment where Email='$email' and  PhoneNumber='$phone'");
$result=mysqli_fetch_array($ret);
$_SESSION['aptno']=$result['AptNumber'];
 echo "<script>window.location.href='thank-you.php'</script>";	
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">
	
  <head>
    <title>BPMS||Home Page</title>
        
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
  </head>
  <body>
	  <?php include_once('includes/header.php');?>
    <!-- END nav -->

    <section id="home-section" class="hero" style="background-image: url(images/bg.jpg);" data-stellar-background-ratio="0.5">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_1.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text mt-5">
		          		<span class="subheading">Beauty Parlour</span>
			            <h1 class="mb-4">Get Pretty Look</h1>
			            <p class="mb-4">We pride ourselves on our high quality work and attention to detail. The products we use are of top quality branded products.</p>
			            
			           
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>

	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_2.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text mt-5">
		          		<span class="subheading">Natural Beauty</span>
			            <h1 class="mb-4">Beauty Salon</h1>
			            <p class="mb-4">This parlour provides huge facilities with advanced technology equipments and best quality service. Here we offer best treatment that you might have never experienced before.</p>
			            
			           
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>


<br>
    <section class="ftco-section ftco-no-pt ftco-booking">
    	<div class="container-fluid px-0">
    		<div class="row no-gutters d-md-flex justify-content-end">
    			<div class="one-forth d-flex align-items-end">
    				<div class="text">
    					<div class="overlay"></div>
    					<div class="appointment-wrap">
    						<span class="subheading">Reservation</span>
								<h3 class="mb-2">Make an Appointment</h3>
		    				<form action="#" method="post" class="appointment-form">
			            <div class="row">
			              <div class="col-sm-12">
			                <div class="form-group">
					              <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="true">
					            </div>
			              </div>
			              <div class="col-sm-12">
			                <div class="form-group">
					              <input type="email" class="form-control" id="appointment_email" placeholder="Email" name="email" required="true">
					            </div>
			              </div>
				            <div class="col-sm-12">
			                <div class="form-group">
					              <div class="select-wrap">
		                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                      <select name="services" id="services" required="true" class="form-control">
		                      	<option value="">Select Services</option>
		                      	<?php $query=mysqli_query($con,"select * from tblservices");
              while($row=mysqli_fetch_array($query))
              {
              ?>
		                       <option value="<?php echo $row['ServiceName'];?>"><?php echo $row['ServiceName'];?></option>
		                       <?php } ?> 
		                      </select>
		                    </div>
					            </div>
			              </div>
			              <div class="col-sm-12">
			                <div class="form-group">
			                  <input type="text" class="form-control appointment_date" placeholder="Date" name="adate" id='adate' required="true">
			                </div>    
			              </div>
			              <div class="col-sm-12">
			                <div class="form-group">
			                  <input type="text" class="form-control appointment_time" placeholder="Time" name="atime" id='atime' required="true">
			                </div>
			              </div>
			              <div class="col-sm-12">
			                <div class="form-group">
			                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="true" maxlength="10" pattern="[0-9]+">
			                </div>
			              </div>
				          </div>
				          <div class="form-group">
			              <input type="submit" name="submit" value="Make an Appointment" class="btn btn-primary">
			            </div>
			          </form>
		          </div>
						</div>
    			</div>
					<div class="one-third">
						<div class="img" style="background-image: url(images/bg-1.jpg);">
						</div>
					</div>
    		</div>
    	</div>
    </section>

		
		<br>
		<!-- <section class="beauty-service text-center py-5">
        <div class="container col-lg-4 col-md-6 col-sm-12">
            <h1 class="fw-bold">Premium <br> Beauty Service</h1>
            <p class="lead">
                Professional, highly trained, and skilled makeup artists are ready to glam you up for every special occasion. 
                We provide service at your hotel, private villa, or yacht – anytime and anywhere.
            </p>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-card">
                        <img src="images/pic5.jpg" alt="Online Booking" class="img-fluid">
                        <div class="overlay">
                            <p>Online Booking</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="images/pic4.jpg" alt="Beauty Product" class="img-fluid">
                        <div class="overlay">
                            <p>Beauty Product</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="images/pic2.jpg" alt="Hair Product" class="img-fluid">
                        <div class="overlay">
                            <p>Hair Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

	<section class="beauty-service text-center py-5" style="padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 class="fw-bold" style="font-size: 32px; font-weight: bold; margin-bottom: 10px;">Premium <br> Beauty Service</h1>
        <p class="lead" style="font-size: 16px; color: #555; max-width: 600px; margin: 0 auto 40px;">
            Professional, highly trained, and skilled makeup artists are ready to glam you up for every special occasion. 
            We provide service at your hotel, private villa, or yacht – anytime and anywhere.
        </p>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <div class="service-card" style="position: relative; width: 300px; max-width: 350px; height: 300px; overflow: hidden; border-radius: 10px; margin: 0 auto 15px;">
                    <img src="images/pic5.jpg" alt="Online Booking" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out;">
                        <p style="font-size: 18px; font-weight: bold; color: white;">Online Booking</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <div class="service-card" style="position: relative; width: 300px; max-width: 350px; height: 300px; overflow: hidden; border-radius: 10px; margin: 0 auto 15px;">
                    <img src="images/pic4.jpg" alt="Beauty Product" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out;">
                        <p style="font-size: 18px; font-weight: bold; color: white;">Beauty Product</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <div class="service-card" style="position: relative; width: 300px; max-width: 350px; height: 300px; overflow: hidden; border-radius: 10px; margin: 0 auto 15px;">
                    <img src="images/pic2.jpg" alt="Hair Product" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out;">
                        <p style="font-size: 18px; font-weight: bold; color: white;">Hair Products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



	<br>
	<section class="beauty-section pt-2 py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Section -->
            <div class="col-lg-6">
                <h2 class="fw-bold mb-2" style="font-size: 36px;">Beauty <br>Treatments</h2>
                <p class="text-secondary mb-4" style="font-size: 18px;">
                    Professional artist that uses mediums applied to the skin to transform or enhance the appearance of a person. 
                    Make-up artists are often referred to as cosmetologists or beauticians, but are different in that they specialize only in make-up and typically.
                </p>

                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between border-bottom pb-2 mb-2 fw-bold" style="font-size: 20px;">
                        <span>Facials</span> <span>Rs.4000</span>
                    </li>
                    <p class="text-secondary" style="font-size: 14px;">Deep cleansing and nourishing treatment for a radiant, healthy glow.</p>

                    <li class="d-flex justify-content-between border-bottom pb-2 mb-2 fw-bold" style="font-size: 20px;">
                        <span>Massages</span> <span>Rs.5500</span>
                    </li>
                    <p class="text-secondary" style="font-size: 14px;">A soothing therapy that relieves tension, improves circulation, and promotes relaxation.</p>

                    <li class="d-flex justify-content-between border-bottom pb-2 mb-2 fw-bold" style="font-size: 20px;">
                        <span>Eyelash extensions</span> <span>Rs.8000</span>
                    </li>
                    <p class="text-secondary" style="font-size: 14px;">Enhance your natural beauty with longer, fuller, and perfectly styled lashes.</p>

                    <li class="d-flex justify-content-between border-bottom pb-2 mb-2 fw-bold" style="font-size: 20px;">
                        <span>Waxing treatments</span> <span>Rs.6000</span>
                    </li>
                    <p class="text-secondary" style="font-size: 14px;">Get smooth, hair-free skin with gentle and long-lasting waxing treatments.</p>

                    <li class="d-flex justify-content-between border-bottom pb-2 mb-2 fw-bold" style="font-size: 20px;">
                        <span>Anti-ageing treatments</span> <span>Rs.10000</span>
                    </li>
                    <p class="text-secondary" style="font-size: 14px;">Rejuvenate your skin and reduce signs of aging with our advanced anti-ageing treatments.</p>
                </ul>

                <a href="services.php" class="d-inline-block mt-2 text-decoration-none text-muted" style="font-size: 16px;">—More Services</a>
            </div>

            <!-- Image Section -->
            <div class="col-lg-6 text-center">
                <img src="images/beauty.jpg" alt="Beauty Treatments" class="img-fluid rounded shadow" style="max-width: 100%;">
            </div>
        </div>
    </div>
</section>

<br>
<section class="text-center py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold mb-3">Meet Our Experts</h2>
        <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">
            Our skilled professionals are dedicated to enhancing your beauty and style.
        </p>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center bg-white p-4 shadow rounded" style="transition: 0.3s;">
                    <img src="images/team1.jpg" alt="Alexa Carter" class="w-100 rounded mb-3" style="height: 250px; object-fit: cover;">
                    <h4 class="fw-bold">Alexa Carter</h4>
                    <p class="text-muted">Services Expert</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="text-center bg-white p-4 shadow rounded" style="transition: 0.3s;">
                    <img src="images/team22.jpg" alt="Emily Ross" class="w-100 rounded mb-3" style="height: 250px; object-fit: cover;">
                    <h4 class="fw-bold">Emily Ross</h4>
                    <p class="text-muted">Master Hair Stylist</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="text-center bg-white p-4 shadow rounded" style="transition: 0.3s;">
                    <img src="images/team5.jpg" alt="Michael Stone" class="w-100 rounded mb-3" style="height: 250px; object-fit: cover;">
                    <h4 class="fw-bold">Michael Stone</h4>
                    <p class="text-muted">Senior Makeup Artist</p>
                </div>
            </div>
        </div>
    </div>
</section>


	

   <?php include_once('includes/footer.php');?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>






  <script>
document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('mouseover', function() {
        this.querySelector('img').style.transform = 'scale(1.1)';
        this.querySelector('.overlay').style.opacity = '1';
    });
    card.addEventListener('mouseout', function() {
        this.querySelector('img').style.transform = 'scale(1)';
        this.querySelector('.overlay').style.opacity = '0';
    });
});
</script>
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