<!-- Include header -->
<?php
  include('header.php');
?>
<!-- Include header Closed -->

<!-- Code for Updation -->
<?php
  if(isset($_POST['update'])){
    $cust_id = $_POST['cust_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $image = $_FILES['cust_image']['name'];
    $image_temp = $_FILES['cust_image']['tmp_name'];
    $img_folder = './image/profile/'.$image;
    move_uploaded_file($image_temp, $img_folder);

    $img_folder = str_replace('./','../',$img_folder);

    $sql = "UPDATE customer SET cust_id = '$cust_id', name = '$name', email = '$email', address = '$address', phone = '$phone', password = '$password', image = '$img_folder' WHERE cust_id = '$cust_id'";

    if($conn -> query($sql)==TRUE){
      $msg = '<small class="alert alert-success">Updated Successfully...!</small>';
    }else{
      $msg = '<small class="alert alert-danger>Failed to Update...!</small>';
    }
  }
?>

<!-- Code to fetch data -->
<?php
  $email = $_SESSION['cust_email_signin'];
  $sql = "SELECT * FROM customer WHERE email = '$email'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
?>

<div class="container-fluid bg-light">
<h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Profile</h2>
</div>
<div class="container-fluid row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="text-center">
        <img src="<?php echo str_replace('..','.',$row['image']);?>" alt="pic" class="adminprofilePic img-thumbnail">
    </div>
    <h3 class="text-center text-secondary mt-1" style="font-family: 'Ubuntu', sans-serif;"><?php echo $row['name'];?></h3>

        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="cust_id" class="form-label text-secondary">Customer ID</label>
              <input type="text" name="cust_id" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo $row['cust_id'];?>" readonly>
            </div>
            <div class="mb-3">
              <label for="cust_name" class="form-label text-secondary">Name</label>
              <input type="text" name="name" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo $row['name'];?>" required>
            </div>
            <div class="mb-3">
              <label for="cust_email" class="form-label text-secondary">Email address</label>
              <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email'];?>" readonly>
            </div>
            <div class="mb-3">
              <label for="cust_address" class="form-label text-secondary">Address</label>
              <input type="text" name="address" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo $row['address'];?>" required>
            </div>
            <div class="mb-3">
              <label for="cust_password" class="form-label text-secondary">Password</label>
              <input type="text" name="password" class="form-control form-control-sm" id="exampleInputPassword1" value="<?php echo $row['password'];?>" required>
            </div>
            <div class="mb-3">
              <label for="cuts_phone" class="form-label text-secondary">Phone</label>
              <input type="text" name="phone" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo $row['phone'];?>" required>
            </div>
            <div class="mb-3">
              <label for="profilepic" class="form-label text-secondary">Profile Image</label>
              <input class="form-control form-control-sm" name="cust_image" id="formFileSm" type="file" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary mt-2">Update</button>
            <?php
            if(isset($msg)){
              echo $msg;
            }
            ?>
          </form>

 
  </div>
  <div class="col-sm-3"></div>
</div>



<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->