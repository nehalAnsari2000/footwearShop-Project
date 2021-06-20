<?php 
// Start session 
if(!isset($_SESSION)){
  session_start();
}

// Include database
include('../dbConnection.php');

// Redirect if admin tries to acces this page without login
if(!isset($_SESSION['is_admin_signin'])){
  echo "<script>location.href='../index.php'</script>";
}

//Code for updating admin details 
if(isset($_POST['admin_update'])){
  $admin_id = $_POST['admin_id'];
  $admin_name = $_POST['admin_name'];
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];
  $admin_phone = $_POST['admin_phone'];

  $admin_image = $_FILES['admin_image']['name'];
  $admin_image_temp = $_FILES['admin_image']['tmp_name'];
  $img_folder = '../image/profile/'.$admin_image;
  move_uploaded_file($admin_image_temp, $img_folder);

  $sql = "UPDATE admin SET admin_id = '$admin_id', name = '$admin_name', email = '$admin_email', phone = '$admin_phone', password = '$admin_password', image = '$img_folder' WHERE admin_id = '$admin_id'";

  if($conn -> query($sql)==TRUE){
    $msg = "<small class='alert alert-success'>Updated successfully !</small>";
    $sql = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
  }else{
    $msg = "<small class='alert alert-danger'>Can't update ! !</small>";
  }
}

// Code to fetch admin data to show the admin creadentials 
if(isset($_SESSION['is_admin_signin'])){
  $admin_email = $_SESSION['admin_email'];
  $sql = "SELECT * FROM admin WHERE email = '$admin_email'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
}


?>

<!-- Include header for admin -->
<?php include('adminheader.php')?>
<!-- Include header for admin close-->

<div class="container-fluid">
  <div class="row mt-2">
    <!-- Include Sidebar -->
    <?php include('adminsider.php')?>
    <!-- Include sidebar closed -->
  
    <!-- Main Content of profile starts here -->
    <div class="col-sm-9">
      <div class="text-center">
        <img src="<?php if(isset($row['image'])){ echo $row['image']; } ?>" alt="pic" class="adminprofilePic img-thumbnail">
      </div>
      <h2 class="text-center fw-bold text-secondary mt-1" style="font-family: 'Ubuntu', sans-serif;"><?php if(isset($row['image'])){ echo $row['name']; } ?></h2>
      <div class="container row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <form method="POST" action="adminindex.php" enctype="multipart/form-data">
            <div class="mb-2">
              <label for="admin_id" class="form-label text-secondary">Admin ID</label>
              <input type="text" class="form-control form-control-sm" id="admin_id" name="admin_id" value="<?php if(isset($row['admin_id'])){ echo $row['admin_id']; } ?>" readonly>
            </div>
            <div class="mb-2">
              <label for="admin_name" class="form-label text-secondary">Name</label>
              <input type="text" class="form-control form-control-sm" id="admin_name"  name="admin_name" value="<?php if(isset($row['name'])){ echo $row['name']; } ?>" required>
            </div>
            <div class="mb-2">
              <label for="admin_email" class="form-label text-secondary">Email address</label>
              <input type="email" class="form-control form-control-sm" id="admin_email" name="admin_email" aria-describedby="emailHelp" value="<?php if(isset($row['email'])){ echo $row['email']; } ?>" readonly>
            </div>
            <div class="mb-2">
              <label for="admin_password" class="form-label text-secondary">Password</label>
              <input type="text" class="form-control form-control-sm" id="admin_password" name="admin_password" value="<?php if(isset($row['password'])){ echo $row['password']; } ?>" required>
            </div>
            <div class="mb-2">
              <label for="admin_phone" class="form-label text-secondary">Phone</label>
              <input type="text" class="form-control form-control-sm" id="admin_phone" name="admin_phone" value="<?php if(isset($row['phone'])){ echo $row['phone']; } ?>" required>
            </div>
            <div class="mb-2">
              <label for="profilepic" class="form-label text-secondary">Profile Image</label>
              <input class="form-control form-control-sm" id="admin_image" name="admin_image" type="file" required>
            </div>
            <div class="mb-2">
              <small><?php if(isset($msg)){ echo $msg; } ?></small>
              <button type="submit" name="admin_update" value="Update" class="btn btn-primary mt-2">Update</button>
            </div>
          </form>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>
    <!-- Main content of profile is end here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->