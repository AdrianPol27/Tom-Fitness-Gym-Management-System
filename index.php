<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./includes/header.php')?>
  <title>Tom Fitness Gym Management System</title>
</head>
<body class="bg-light">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TFGMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link active" href="index.php">Home</a>
            <a class="nav-link mx-3" href="login.php">Login</a>
            <a class="nav-link" href="register.php">Register</a>
          </div>
        </div>
      </div>
    </nav>
  </div>
  
  <?php include('./includes/scripts-file.php')?>
</body>
</html>