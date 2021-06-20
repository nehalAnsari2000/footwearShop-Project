<?php
// Start session 
if(!isset($_SESSION)){
  session_start();
}

// Include Database
include_once("../dbConnection.php");

// Admin signin verification starts here
if(!isset($_SESSION['is_admin_signin'])){
  if(isset($_POST['admin_signin']) && isset($_POST['admin_email']) && isset($_POST['admin_pass'])){
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];
  
    $sql = "SELECT email, password FROM admin where email='".$admin_email."' AND password='".$admin_pass."'";
  
    $result = $conn -> query($sql);
    $row = $result->num_rows;
    if($row === 1){
      $_SESSION['is_admin_signin'] = true;
      $_SESSION['admin_email'] = $admin_email;
      echo json_encode($row);
    }else if($row === 0){
      echo json_encode($row);
    }    
  }  
}
// Admin signin verification ends here

?>