<?php

  define('DB_SERVER','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','tfgms');

  $errors = array();
  $errorSuccess = array();
  $errorInfo = array();

  class Functions {

    // DATABASE CONNECTION
    function __construct() {
      $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
      $this->dbh = $conn;
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $_SESSION['conn'] = $conn;
    }


    function signIn($username, $password) {
      $result = mysqli_query($this->dbh, "SELECT * FROM tbl_users WHERE Username = '$username' AND Password = '$password'");
      return $result;
    }
    
    function register($firstName, $lastName, $address, $mobileNumber, $sex, $age, $exerciseType, $username, $password) {
      $result = mysqli_query($this->dbh, "INSERT INTO tbl_users (first_name, last_name, address, mobile_number, sex, age, exercise_type, username, password, Date_registered, Is_activated) VALUES ('$firstName','$lastName','$address','$mobileNumber','$sex','$age','$exerciseType','$username','$password','0000-00-00','No')");
      return $result;
    }

    function addMember($name, $email) {
      $result = mysqli_query($this->dbh, "INSERT INTO tbl_users (name, email) VALUES ('$name', '$email')");
    }
    

  }

?>