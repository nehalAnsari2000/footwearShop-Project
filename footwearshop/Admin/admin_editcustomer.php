<!-- Include header for admin -->
<?php include('adminheader.php')?>
<!-- Include header for admin close-->

<!-- Include database -->
<?php include('../dbConnection.php')?>
<!-- Include database close-->

<?php
// Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }
?>

<div class="container-fluid">
  <div class="row mt-2">
    <!-- Include Sidebar -->
    <?php include('adminsider.php')?>
    <!-- Include sidebar closed -->
  
    <!-- Main Content of Edit Item starts here -->
    <div class="container-fluid col-sm-9">
      <div class="container-fluid">
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Edit Customer</h2>
      </div>
      
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">

            <!-- Php Code to Update customer -->
            <?php
              if(isset($_POST['edit_cistomer'])){
                  $cust_id = $_POST['cust_id'];
                  $cust_name = $_POST['cust_name'];
                  $cust_email = $_POST['cust_email'];
                  $cust_address = $_POST['cust_address'];
                  $cust_phone = $_POST['cust_phone'];
                  $cust_password = $_POST['cust_password'];

                  $cust_image = $_FILES['cust_image']['name'];
                  $cust_image_temp = $_FILES['cust_image']['tmp_name'];
                  $img_folder = '../image/profile/'.$cust_image;
                  move_uploaded_file($cust_image_temp, $img_folder);

                  $sql = "UPDATE customer SET cust_id = '$cust_id', name = '$cust_name', email = '$cust_email', address = '$cust_address', phone = '$cust_phone', password = '$cust_password', image = '$img_folder' WHERE cust_id = '$cust_id'";

                  if($conn -> query($sql)==TRUE){
                    $msg = "<small class='alert alert-success'>Updated successfully !</small>";
                    $sql = "SELECT * FROM customer WHERE cust_id = {$_POST['cust_id']}";
                    $result = $conn -> query($sql);
                    $row = $result -> fetch_assoc();
                  }else{
                    $msg = "<small class='alert alert-danger'>Can't update ! !</small>";
                  }
                  
                }
              
            ?>
            <!-- Php Code to Update customer ends-->


            <!-- Php Code to fetch data from database -->
            <?php
              if(isset($_POST['edit_cust'])){
                $sql = "SELECT * FROM customer WHERE cust_id = {$_POST['cust_id']}";
                $result = $conn -> query($sql);
                $row = $result -> fetch_assoc();
              }
            ?>

            <div class="text-center">
              <img src="<?php if(isset($row['image'])){echo $row['image']; } ?>" alt="pic" style="max-width:150px; border-radius:50%" class="img-fluid img-thumbnail">
            </div>

            <form method="POST" action="admin_editcustomer.php" enctype="multipart/form-data">
                  <div class="mt-2">
                    <label for="cust_id" class="form-label text-secondary">Customer ID</label>
                    <input type="text" class="form-control form-control-sm" id="cust_id"
                    name="cust_id" value="<?php if(isset($row['cust_id'])){echo $row['cust_id']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="cust_name" class="form-label text-secondary">Customer Name</label>
                    <input type="text" class="form-control form-control-sm" id="cust_name" name="cust_name" value="<?php if(isset($row['name'])){echo $row['name']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="cust_email" class="form-label text-secondary">Email</label>
                    <input type="Email" class="form-control form-control-sm" id="cust_email"
                    name="cust_email" value="<?php if(isset($row['email'])){echo $row['email']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="cust_address" class="form-label text-secondary">Address</label>
                    <input type="text" class="form-control form-control-sm" id="cust_address"
                    name="cust_address" value="<?php if(isset($row['address'])){echo $row['address']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="cust_phone" class="form-label text-secondary">Phone</label>
                    <input type="text" class="form-control form-control-sm" id="cust_phone"
                    name="cust_phone" value="<?php if(isset($row['phone'])){echo $row['phone']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="cust_password" class="form-label text-secondary">Password</label>
                    <input type="text" class="form-control form-control-sm" id="cust_password" name="cust_password" value="<?php if(isset($row['password'])){echo $row['password']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="profilepic" class="form-label">Image</label>
                    <input class="form-control form-control-sm" id="cust_image" 
                    name="cust_image" 
                    type="file" 
                    required>
                  </div>        
                  <div class="modal-footer">
                    <small><?php if(isset($msg)){echo $msg; }?></small>
                    <button type="submit" name="edit_cistomer" value="Edit_cistomer" class="btn btn-primary">Edit</button>
                  </div>     
                </form>

        </div>
        <div class="col-sm-2"></div>
      </div>      
    </div>    
    <!-- Main content of Edit Item is end here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->