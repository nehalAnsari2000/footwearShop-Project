<!-- Include header for admin -->
<?php include('./adminheader.php')?>
<!-- Include header for admin close-->

<!-- Include Database -->
<?php include('../dbConnection.php');  

// Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }

// php code to insert cust data in customer table
if(isset($_POST['cust_btn'])){
  if(isset($_POST['cust_name']) && isset($_POST['cust_email']) && isset($_POST['cust_address']) && isset($_POST['cust_password']) && isset($_POST['cust_phone']) && isset($_FILES['cust_image']['name'])){
    $cust_name = $_POST['cust_name'];
    $cust_email = $_POST['cust_email'];
    $cust_address = $_POST['cust_address'];
    $cust_password = $_POST['cust_password'];
    $cust_phone = $_POST['cust_phone'];
    
    $cust_image = $_FILES['cust_image']['name'];
    $cust_image_temp = $_FILES['cust_image']['tmp_name'];
    $img_folder = '../image/profile/'.$cust_image;
    move_uploaded_file($cust_image_temp, $img_folder);

    $sql = "INSERT INTO customer(name, address, email, phone, image, password) VALUES('$cust_name', '$cust_address', '$cust_email', '$cust_phone', '$img_folder', '$cust_password')";

    if($conn -> query($sql) == TRUE){
      $msg = "<small class='alert alert-success'>Customer Added Successfully !</small>";  
    }else{
      $msg = "<small class='alert alert-danger'>Can't Add, Something went wrong !</small>";
    }
  }
  else{
    $msg = "<small class='alert alert-danger'>Fill All Fields !</small>";
  }
}

?>

<div class="container-fluid">
  <div class="row mt-2">
    <!-- Include Sidebar -->
    <?php include('./adminsider.php')?>
    <!-- Include sidebar closed -->
  
    <!-- Main Content of Edit Order starts here -->
    <div class="container-fluid col-sm-9">
      <div class="container-fluid">
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Add Customer</h2>
      </div>
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
        <form id="createCustomerForm" action="add_customer.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-1">
                    <label for="cust_name" class="form-label text-secondary">Name</label>
                    <input type="text" class="form-control form-control-sm" id="cust_name" name="cust_name" required>
                  </div>
                  <div class="mb-1">
                    <label for="cust_email" class="form-label text-secondary">Email</label><small id="emailMsgAdmin"></small>
                    <input type="email" class="form-control form-control-sm" id="cust_email_admin" name="cust_email" required>
                  </div>
                  <div class="mb-1">
                    <label for="cust_address" class="form-label text-secondary">Address</label>
                    <input type="text" class="form-control form-control-sm" id="cust_address" name="cust_address" required>
                  </div>
                  <div class="mb-1">
                    <label for="cust_password" class="form-label text-secondary">Password</label>
                    <small id="passwordMsgAdmin"></small>
                    <input type="password" class="form-control form-control-sm" id="cust_password" placeholder="Password (Atleast 6 characters)" name="cust_password" required>
                  </div>
                  <div class="mb-1">
                    <label for="cust_phone" class="form-label text-secondary">Phone</label>
                    <small id="phoneMsgAdmin"></small>
                    <input type="text" class="form-control form-control-sm" id="cust_phone" name="cust_phone" required>
                  </div>
                  <div class="mb-1">
                    <label for="cust_pic" class="form-label">Image</label>
                    <input class="form-control form-control-sm" id="cust_image" name="cust_image" type="file" required>
                  </div>                       
                  <div class="modal-footer">
                    <small id="createCustomerMsg"><?php if(isset($msg)){ echo $msg; } ?></small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearCreateCustomerFormWhileCancle()">Close</button>
                    <button type="submit" name="cust_btn" id="cust_btn" class="btn btn-primary">Add</button>
                  </div>     
                </form>
        </div>
        <div class="col-sm-2"></div>
      </div>      
    </div>    
    <!-- Main content of Edit Order is end here -->
  </div>
</div>

<!-- Include footer for admin -->
<?php include('./adminfooter.php')?>
<!-- Include footer for admin close-->