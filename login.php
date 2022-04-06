<?php

  include_once("./includes/functions.php"); // Include functions.php
  $functions = new Functions(); // Create function object
  $errors = array();

  if (isset($_POST['login_btn'])) { // Kung ang login button tuplokon
    $username = $_POST['username']; // Kuhaon ang email gikan sa form
    $password = $_POST['password']; // Kuhaon ang password gikan sa form
    if (empty($username)) {
      array_push($errors, "Username should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($password)) {
      array_push($errors, "Password should not be empty!"); // Mag push og error kung empty ang password
    } else {
      $signIn = $functions->signIn($username, $password); // i excecute ang function nga naa sa functions.php daw i select tanan ang email og password sulod sa users table
      if ($signIn -> num_rows > 0) { // kung ang username og password wala sa table 
        while ($account = $signIn -> fetch_assoc()) {
          if ($account['Username'] == $username && $account['Password'] == $password) {

             // Redirect kung user
             if ($account['User_type_ID'] == '0') {
              if ($account['Is_activated'] == 'No') {
                array_push($errors, "Your account has not been activated by the admin!");
              } else {
                header('Location: ./user/index.php');
              }
            }

            // Redirect kung admin
            if ($account['User_type_ID'] == '1') {
              header('Location: ./admin/index.php');
            }
           
          }
        }
      } else {
        array_push($errors, "No account found!"); // Mag push og error kung walay account makita
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./includes/header.php')?>
  <title>Tom Fitness Gym Management System | Home</title>
</head>
<style>
  section.content-wrapper {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    height: calc(100vh - 60px);
  }
</style>
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
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link active mx-3" href="login.php">Login</a>
            <a class="nav-link" href="register.php">Register</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <section class="content-wrapper">
    <main class="form-signin">
      <form action="login.php" method="post">
        <div class="mx-5">
          <!-- <img class="img-fluid" src="./assets/img/cmu_logo.png" alt="CMU Logo"> -->
        </div>
        <h1 class="h3 my-4 fw-normal text-center">Login</h1>
        <?php include('./includes/errors.php'); ?>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="username" name="username" placeholder="Email">
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login_btn">Sign in</button>
      </form>
    </main>
  </section>
    
  <?php include('./includes/scripts-file.php')?>
</body>
</html>