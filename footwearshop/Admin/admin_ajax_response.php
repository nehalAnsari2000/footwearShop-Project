<?php
  // include database-----------------------------------------------------------------
  include('../dbConnection.php');

  //code for verification of email whether it exists or not  ------------------------
  if(isset($_POST['checkmail']) && isset($_POST['create_admin_email'])){
    $create_admin_email = $_POST['create_admin_email'];
    $sql = "SELECT email FROM admin WHERE email ='".$create_admin_email."'";
    $result = $conn -> query($sql);
    $row = $result -> num_rows;
    echo json_encode($row);
  }

  //code for verification of email whether it exists or not ------------------------------
  if(isset($_POST['checkmail']) && isset($_POST['cust_email'])){
    $cust_email = $_POST['cust_email'];
    $sql = "SELECT email FROM customer WHERE email ='".$cust_email."'";
    $result = $conn -> query($sql);
    $row = $result -> num_rows;
    echo json_encode($row);
  }

    
?>