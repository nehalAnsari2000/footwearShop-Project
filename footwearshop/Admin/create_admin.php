<!-- Include header for admin -->
<?php include('./adminheader.php')?>
<!-- Include header for admin close-->

<!-- Include Database -->
<?php
  include("../dbConnection.php");

  // Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }

  //php Code for creating admin 
  if(isset($_POST['create_admin_btn'])){
    if(isset($_POST['create_admin_name']) && isset($_POST['create_admin_email']) && isset($_POST['create_admin_password']) && isset($_POST['create_admin_phone']) && isset($_FILES['create_admin_image']['name'])){
      $create_admin_name = $_POST['create_admin_name'];
      $create_admin_email = $_POST['create_admin_email'];
      $create_admin_password = $_POST['create_admin_password'];
      $create_admin_phone = $_POST['create_admin_phone'];
      
      $create_admin_image = $_FILES['create_admin_image']['name'];
      $create_admin_image_temp = $_FILES['create_admin_image']['tmp_name'];
      $img_folder = '../image/profile/'.$create_admin_image;
      move_uploaded_file($create_admin_image_temp, $img_folder);
  
      $sql = "INSERT INTO admin(name, email, phone, password, image) VALUES('$create_admin_name', '$create_admin_email', '$create_admin_phone', '$create_admin_password','$img_folder')";
  
      if($conn -> query($sql) == TRUE){
        $msg = "<small class='alert alert-success'>Admin Created Successfully !</small>";  
      }else{
        $msg = "<small class='alert alert-danger'>Can't Create, Something went wrong !</small>";
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
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Create Admin</h2>
      </div>
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
        <form id="create_admin_form" action="create_admin.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-1">
                    <label for="admin_name" class="form-label text-secondary">Name</label>
                    <input type="text" class="form-control form-control-sm" id="create_admin_name"
                    name="create_admin_name" required>
                  </div>
                  <div class="mb-1">
                    <label for="admin_email" class="form-label text-secondary">Email</label>
                    <small id="create_admin_email_msg"></small>
                    <input type="email" class="form-control form-control-sm" id="create_admin_email" name="create_admin_email" required>
                  </div>
                  <div class="mb-1">
                    <label for="admin_password" class="form-label text-secondary">Password</label>
                    <small id="create_admin_password_msg"></small>
                    <input type="password" class="form-control form-control-sm" id="create_admin_password" placeholder="Password (Atleast 6 characters)" name="create_admin_password" required>
                  </div>
                  <div class="mb-1">
                    <label for="admin_phone" class="form-label text-secondary">Phone</label>
                    <small id="create_admin_phone_msg"></small>
                    <input type="text" class="form-control form-control-sm" id="create_admin_phone" name="create_admin_phone" required>
                  </div>
                  <div class="mb-1">
                    <label for="profilepic" class="form-label">Item Image</label>
                    <input class="form-control form-control-sm" id="create_admin_image" type="file" name="create_admin_image" required>
                  </div>                       
                  <div class="modal-footer">
                    <small id="create_admin_msg"><?php if(isset($msg)){echo $msg; } ?></small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearCreateAdminForm()">Close</button>
                    <button type="submit" class="btn btn-primary" name="create_admin_btn" id="create_admin_btn">Create</button>
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