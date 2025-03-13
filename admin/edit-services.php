<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $sername = mysqli_real_escape_string($con, $_POST['sername']);
        $cost = mysqli_real_escape_string($con, $_POST['cost']);
        $eid = $_GET['editid'];

        // Fetch existing image path
        $result = mysqli_query($con, "SELECT Image FROM tblservices WHERE ID='$eid'");
        $row = mysqli_fetch_assoc($result);
        $existingImage = $row['Image'];

        if (!empty($_FILES["image"]["name"])) {
            $imageName = basename($_FILES["image"]["name"]);
            $tempName = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];
            $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // Allowed image types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (!in_array($imageType, $allowedTypes)) {
                echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG, WEBP, and GIF allowed.');</script>";
            } elseif ($imageSize > 5000000) { // 5MB max
                echo "<script>alert('Image size must be less than 5MB.');</script>";
            } else {
                $folder = "uploads/" . uniqid() . "_" . $imageName;

                // Ensure directory exists
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                if (move_uploaded_file($tempName, $folder)) {
                    // Delete old image if a new one is uploaded
                    if (!empty($existingImage) && file_exists($existingImage)) {
                        unlink($existingImage);
                    }

                    // Update query with new image
                    $query = mysqli_query($con, "UPDATE tblservices SET ServiceName='$sername', Cost='$cost', Image='$folder' WHERE ID='$eid'");
                }
            }
        } else {
            // Update query without changing the image
            $query = mysqli_query($con, "UPDATE tblservices SET ServiceName='$sername', Cost='$cost' WHERE ID='$eid'");
        }

        if ($query) {
            echo "<script>alert('Service has been Updated.');</script>";
            echo "<script>window.location.href = 'manage-services.php';</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Elegance Salon | Update Services</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <script src="js/jquery-1.11.1.min.js"></script>
</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Update Services</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Update Parlour Services:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center"> 
                                    <?php if (isset($msg)) echo $msg; ?> 
                                </p>
                                <?php
                                $cid = $_GET['editid'];
                                $ret = mysqli_query($con, "SELECT * FROM tblservices WHERE ID='$cid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?> 
                                <div class="form-group">
                                    <label for="sername">Service Name</label>
                                    <input type="text" class="form-control" id="sername" name="sername" 
                                           value="<?php echo $row['ServiceName']; ?>" required="true">
                                </div>
                                <div class="form-group"> 
                                    <label for="cost">Cost</label> 
                                    <input type="text" id="cost" name="cost" class="form-control" 
                                           value="<?php echo $row['Cost']; ?>" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Current Image:</label><br>
                                    <img src="<?php echo $row['Image']; ?>" width="100" height="100"><br><br>
                                    <label for="image">Select New Image</label>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                </div>
                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button> 
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
