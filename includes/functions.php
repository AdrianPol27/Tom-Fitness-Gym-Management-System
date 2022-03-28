<?php

  define('DB_SERVER','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','gym');

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


    function signIn($email, $password) {
      $result = mysqli_query($this->dbh, "SELECT * FROM tbl_users WHERE Email = '$email' AND Password = '$password'");
      return $result;
    }

  }

?>