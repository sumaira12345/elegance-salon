<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $sername = $_POST['sername'];
        $cost = $_POST['cost'];
        
        // Handling image upload
        $imageName = $_FILES["image"]["name"];
        $tempName = $_FILES["image"]["tmp_name"];
        $folder = "uploads/" . $imageName;

        // Check if directory exists, if not, create it
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Move uploaded file to the directory
        if (move_uploaded_file($tempName, $folder)) {
            // Insert data into database
            $query = mysqli_query($con, "INSERT INTO tblservices(ServiceName, Cost, Image) VALUES('$sername', '$cost', '$folder')");

            if ($query) {
                echo "<script>alert('Service has been added successfully!');</script>";
                echo "<script>window.location.href = 'add-services.php';</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Image upload failed. Please try again.');</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Elegance Salon | Add Services</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
</head> 
<body>
    <div class="main-content">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>

        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add Services</h3>
                    <div class="form-grids row widget-shadow">
                        <div class="form-title">
                            <h4>Parlour Services:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
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
                                <button type="submit" name="submit" class="btn btn-primary">Add Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>

<?php } ?>
