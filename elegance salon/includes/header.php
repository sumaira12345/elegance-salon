<?php
// session_start();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">









<nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-#e83e8c ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Elegance Salon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
            
            <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
           
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="feedback.php" class="nav-link">Feedback</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
            
            <li class="nav-item"><a href="../admin/index.php" class="nav-link">Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




    