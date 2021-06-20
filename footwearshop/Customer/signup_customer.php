<?php
// Start session 
if(!isset($_SESSION)){
  session_start();
}

// Include Database
include_once("../dbConnection.php");

//code for verification of email whether it exists or not 
if(isset($_POST['checkmail']) && isset($_POST['cust_email'])){
  $cust_email = $_POST['cust_email'];
  $sql = "SELECT email FROM customer WHERE email ='".$cust_email."'";
  $result = $conn -> query($sql);
  $row = $result -> num_rows;
  echo json_encode($row);
}

// Customer Signin verification starts here
if(!isset($_SESSION['is_signin'])){
  if(isset($_POST['cust_signin']) && isset($_POST['cust_email_signin']) && isset($_POST['cust_pass_signin'])){
    $cust_email_signin = $_POST['cust_email_signin'];
    $cust_pass_signin = $_POST['cust_pass_signin'];
  
    $sql = "SELECT email, password FROM customer where email='".$cust_email_signin."' AND password='".$cust_pass_signin."'";
  
    $result = $conn -> query($sql);
    $row = $result->num_rows;
    if($row === 1){
      $_SESSION['is_signin'] = true;
      $_SESSION['cust_email_signin'] = $cust_email_signin;
      echo json_encode($row);
    }else if($row === 0){
      echo json_encode($row);
    }    
  }  
}
// Customer Signin verification ends here


// code for inserting data in customer table while signing up starts here
if(isset($_POST['cust_signup']) && isset($_POST['cust_name']) && isset($_POST['cust_address']) && isset($_POST['cust_email']) && isset($_POST['cust_pass'])){
  $cust_name = $_POST['cust_name'];
  $cust_address = $_POST['cust_address'];
  $cust_email = $_POST['cust_email'];
  $cust_pass = $_POST['cust_pass'];

  $sql = "INSERT INTO customer(name, address, email, password) VALUES('$cust_name', '$cust_address', '$cust_email', '$cust_pass')";

  if($conn -> query($sql) == TRUE){
    echo json_encode("OK");
  }else{
    echo json_encode("Failed");
  }
}
// code for inserting data in customer table while signing up ends here




?>