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

    <!-- Delete Cust Code -->
    <?php
      if(isset($_POST['delete_cust'])){
        $cust_id = $_POST['cust_id'];
        $sql="DELETE FROM customer WHERE cust_id = {$cust_id}";
        $result = $conn -> query($sql);
      }
    ?>
    <!-- Delete Cust Code Ends -->

    <!-- Main Content of Customer List starts here -->
    <div class="container-fluid col-sm-9">
        <!-- Header serch bar and heading start -->
        <div class="row bg-light">
        <div class="col-sm-5 text-center">
          <h2 class="fw-bold text-secondary mt-1" style="font-family: 'Ubuntu', sans-serif;">Customer List</h2>     
        </div>
        <div class="col-sm-7">
          <form class="d-flex" method="POST" action="admin_customerlist.php">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search by Name" aria-label="Search" name="customer_name" required>
            <button class="btn btn-outline-secondary" name="search_cust" value="search" type="submit">Search</button>
          </form>
        </div>
      </div>
      <!-- Header serch bar and heading Ends -->

      <!--  Customer list start-->
      <div class="mt-3">
      <?php
        if(isset($_POST['search_cust'])){
          $customer_name = $_POST['customer_name'];
          $sql = "SELECT * FROM customer WHERE name = '$customer_name'";
        }else{                                         // Php code to display cust list 
          $sql = "SELECT * FROM customer";
        }
        $result = $conn -> query($sql);
        if($result->num_rows > 0){
      ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-secondary">Image</th>
              <th scope="col" class="text-secondary">ID</th>
              <th scope="col" class="text-secondary">Name</th>
              <th scope="col" class="text-secondary">Email</th>
              <th scope="col" class="text-secondary">Address</th>
              <th scope="col" class="text-secondary">Phone</th>
              <th scope="col" class="text-secondary">Password</th>
              <th scope="col" class="text-secondary">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result -> fetch_assoc()){?>
            <tr>
              <td>
                <img src="<?php echo $row['image']; ?>" alt="pic" style="max-width:50px; border-radius:50%" class="img-fluid">
              </td>
              <td class="text-secondary"><?php echo $row['cust_id']; ?></td>
              <td class="text-secondary"><?php echo $row['name']; ?></td>
              <td class="text-secondary"><?php echo $row['email']; ?></td>
              <td class="text-secondary"><?php echo $row['address']; ?></td>
              <td class="text-secondary"><?php echo $row['phone']; ?></td>
              <td class="text-secondary"><?php echo $row['password']; ?></td>
              <td>
                <form action="" method="POST" class="d-inline">
                  <input type="hidden" name="cust_id" value="<?php echo $row['cust_id']?>">
                  <button type="submit" class="btn btn-secondary btn-sm" name="delete_cust" value="Delete_cust">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>

                <form action="admin_editcustomer.php" method="POST" class="d-inline">
                  <input type="hidden" name="cust_id" value="<?php echo $row['cust_id']?>">
                  <button type="submit" class="btn btn-secondary btn-sm" name="edit_cust" value="Edit_cust">
                      <i class="fas fa-pen-square"></i>
                  </button>
                </form>

              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } else{?>
          <h3 class="text-secondary">No customers available...!</h3>
        <?php } ?>
      </div>
      <!--  Customer list Ends-->

    </div>    
    <!-- Main content of Customer List ends here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->