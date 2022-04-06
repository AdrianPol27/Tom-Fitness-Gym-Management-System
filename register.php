<?php

  include_once("./includes/functions.php"); // Include functions.php
  $functions = new Functions(); // Create function object
  $errors = array();

  if (isset($_POST['register_btn'])) { // Kung ang login button tuplokon
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $mobileNumber = $_POST['mobile_number'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $exerciseType = $_POST['exercise_type'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Kuhaon ang password gikan sa form
    if (empty($firstName)) {
      array_push($errors, "First Name should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($lastName)) {
      array_push($errors, "Last name should not be empty!");
    }
    if (empty($address)) {
      array_push($errors, "Address should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($mobileNumber)) {
      array_push($errors, "Mobile Number should not be empty!"); // Mag push og error kung empty ang email
    }
    if ($sex == 'None') {
      array_push($errors, "Sex should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($age)) {
      array_push($errors, "Age should not be empty!"); // Mag push og error kung empty ang email
    }
    if ($exerciseType == 'None') {
      array_push($errors, "Exercise Type should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($username)) {
      array_push($errors, "Username should not be empty!"); // Mag push og error kung empty ang email
    }
    if (empty($password)) {
      array_push($errors, "Password should not be empty!"); // Mag push og error kung empty ang password
    } else {
      $register = $functions->register($firstName, $lastName, $address, $mobileNumber, $sex, $age, $exerciseType, $username, $password); // i excecute ang function nga naa sa functions.php daw i select tanan ang email og password sulod sa users table
      
      if ($register) {
        header('Location: login.php');
      } else {
        array_push($errors, "An error occured when creating an account!");
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
            <a class="nav-link mx-3" href="login.php">Login</a>
            <a class="nav-link active" href="register.php">Register</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <section class="content-wrapper">
    <main class="form-signin">
      <form action="register.php" method="post">
        <div class="mx-5">
          <!-- <img class="img-fluid" src="./assets/img/cmu_logo.png" alt="CMU Logo"> -->
        </div>
        <h1 class="h3 my-4 fw-normal text-center">Register</h1>
        <?php include('./includes/errors.php'); ?>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name">
          <label for="firstName">First Name</label>
        </div>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name">
          <label for="lastName">Last Name</label>
        </div>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="address" name="address" placeholder="Address">
          <label for="address">Address</label>
        </div>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="mobileNumber" name="mobile_number" placeholder="Mobile Number">
          <label for="mobileNumber">Mobile Number</label>
        </div>
        <div class="form-floating mb-1">
          <select class="form-select" id="sex" name="sex">
            <option value="None" selected>Select Sex</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
          <label for="sex">Sex</label>
        </div>
        <div class="form-floating mb-1">
          <input type="number" class="form-control" id="age" name="age" placeholder="Age">
          <label for="age">Age</label>
        </div>
        <div class="form-floating mb-1">
          <select class="form-select" id="exerciseType" name="exercise_type">
            <option value="None" selected>Select Exercise Type</option>
            <option value="Monthly">Monthly</option>
            <option value="Session">Session</option>
          </select>
          <label for="exerciseType">Exercise Type</label>
        </div>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="register_btn">Register</button>
      </form>
    </main>
  </section>
    
  <?php include('./includes/scripts-file.php')?>
</body>
</html>