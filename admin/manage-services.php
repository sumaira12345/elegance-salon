<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (!isset($_SESSION['bpmsaid'])) {
    header('location:logout.php');
    exit();
}

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Deleting Service Securely
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && isset($_GET['csrf'])) {
    if (hash_equals($_SESSION['csrf_token'], $_GET['csrf'])) {
        $id = intval($_GET['id']);
        $stmt = $con->prepare("DELETE FROM tblservices WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Service deleted successfully.');</script>";
        } else {
            echo "<script>alert('Error: Unable to delete service.');</script>";
        }
        echo "<script>window.location.href='manage-services.php'</script>";
        $stmt->close();
    } else {
        echo "<script>alert('Invalid CSRF token.');</script>";
        echo "<script>window.location.href='manage-services.php'</script>";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Elegance Salon || Manage Services</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link href="css/animate.css" rel="stylesheet">
    <script src="js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Header -->
        <?php include_once('includes/header.php'); ?>
        <!-- Main Content -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Manage Services</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Update Services:</h4>
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Service Name</th> 
                                    <th>Service Price</th> 
                                    <th>Service Image</th>
                                    <th>Creation Date</th>
                                    <th>Action</th> 
                                </tr> 
                            </thead> 
                            <tbody>
                                <?php
                                $ret = mysqli_query($con, "SELECT * FROM tblservices");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                    // Corrected Image Path
                                    $imagePath = "/ES/elegance salon/" . $row['Image'];
                                    $serverPath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;

                                    echo "<tr>"; 
                                    echo "<th scope='row'>" . $cnt . "</th>"; 
                                    echo "<td>" . htmlspecialchars($row['ServiceName']) . "</td>"; 
                                    echo "<td>" . htmlspecialchars($row['Cost']) . "</td>";

                                    // Debugging & Displaying Image
                                    if (!empty($row['Image']) && file_exists($serverPath)) {
                                        echo "<td><img src='" . $imagePath . "' width='100' height='80'></td>";
                                    } else {
                                        echo "<td style='color:red;'>❌ Image Not Found: " . $imagePath . "</td>";
                                    }

                                    echo "<td>" . htmlspecialchars($row['CreationDate']) . "</td>"; 
                                    echo "<td>
                                            <a href='edit-services.php?editid=" . $row['ID'] . "'>Edit</a> | 
                                            <a href='#' onclick='confirmDelete(" . $row['ID'] . ", \"" . $_SESSION['csrf_token'] . "\")'>Delete</a>
                                          </td>"; 
                                    echo "</tr>";   

                                    $cnt++;
                                } 
                                ?>
                            </tbody> 
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- Scripts -->
    <script>
        function confirmDelete(id, csrfToken) {
            if (confirm("Are you sure you want to delete this service?")) {
                window.location.href = "manage-services.php?action=delete&id=" + id + "&csrf=" + csrfToken;
            }
        }
    </script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
