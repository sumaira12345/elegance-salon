<?php
session_start();
session_unset();  // Remove session variables
session_destroy(); // Destroy session
header("Location: index.php"); // Redirect to homepage
exit();
?>
