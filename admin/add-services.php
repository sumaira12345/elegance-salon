<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $sername = ( $_POST['sername']);
        $cost = ( $_POST['cost']);

        // Handling image upload
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $imageName = basename($_FILES["image"]["name"]);
            $tempName = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];
            $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // Define allowed image types
            $allowedTypes = ['jpg', 'jpeg', 'png','webp', 'gif'];

            if (!in_array($imageType, $allowedTypes)) {
                echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG, and GIF allowed.');</script>";
            } elseif ($imageSize > 5000000) { // 5MB max size
                echo "<script>alert('Image size must be less than 5MB.');</script>";
            } else {
                $folder = "uploads/" . $imageName;

                // Check if directory exists, if not, create it
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Move uploaded file to the directory
                if (move_uploaded_file($tempName, $folder)) {
                    $query = mysqli_query($con, "INSERT INTO tblservices (ServiceName, Cost, Image) VALUES ('$sername', '$cost', '$folder')");

                    if ($query) {
                        echo "<script>alert('Service has been added.');</script>";
                        echo "<script>window.location.href = 'add-services.php'</script>";
                    } else {
                        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('Image upload failed. Please try again.');</script>";
                }
            }
        } else {
            echo "<script>alert('Please select a valid image file.');</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Elegance Salon | Add Services</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font-Awesome Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Web Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!-- Animate -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head> 

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php');?>

        <!-- Header -->
        <?php include_once('includes/header.php');?>

        <!-- Main Content -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add Services</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Parlour Services:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php if($msg) { echo $msg; } ?>
                                </p>

                                <div class="form-group">
                                    <label for="sername">Service Name</label>
                                    <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" required>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Select Image</label>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                </div>
                                
                                <button type="submit" name="submit" class="btn btn-default">Add</button>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once('includes/footer.php');?>

    </div>

    <!-- JavaScript Files -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;
        
        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>

    <!-- Scrolling JS -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>
</html>

<?php } ?>
