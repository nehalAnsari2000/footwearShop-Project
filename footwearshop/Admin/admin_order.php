<!-- Include header for admin -->
<?php include('adminheader.php')?>
<!-- Include header for admin close-->

<!-- Include Database -->
<?php include('../dbConnection.php')?>
<!-- Include Database closed -->

<?php
// Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }
?>

<?php 
  // Code for deletion of order
  if(isset($_POST['delete_order'])){
    $order_id = $_POST['order_id'];
    $sql = "DELETE FROM order_bill WHERE order_id = '$order_id'";
    $result = $conn -> query($sql);
  }
?>

<div class="container-fluid">
  <div class="row mt-2">
    <!-- Include Sidebar -->
    <?php include('adminsider.php')?>
    <!-- Include sidebar closed -->
  
    <!-- Main Content of Order List starts here -->
    <div class="container-fluid col-sm-9">
        <!-- Header serch bar and heading start -->
        <div class="row bg-light">
        <div class="col-sm-5 text-center">
          <h2 class="fw-bold text-secondary mt-1" style="font-family: 'Ubuntu', sans-serif;">Order List</h2>     
        </div>
        <div class="col-sm-7">
          <form class="d-flex" method="POST" action="admin_order.php">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search by Order ID" aria-label="Search" name="orderid" required>
            <button class="btn btn-outline-secondary" name="search_order" value="Search" type="submit">Search</button>
          </form>
        </div>
      </div>
      <!-- Header serch bar and heading Ends -->

      <!--  Order list start-->
      <div class="mt-3">

      <?php 
      if(isset($_POST['search_order'])){
        $orderid = $_POST['orderid'];
        $sql = "SELECT * FROM order_bill WHERE order_id = '$orderid'";
      }else{
        // Code for fetching all ordres
        $sql = "SELECT * FROM order_bill";
      }
        $result = $conn -> query($sql);
        if($result -> num_rows > 0){
      ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-secondary">Trans ID</th>
              <th scope="col" class="text-secondary">Cust ID</th>
              <th scope="col" class="text-secondary">Cust Name</th>
              <th scope="col" class="text-secondary">Amount</th>
              <th scope="col" class="text-secondary">Date</th>
              <th scope="col" class="text-secondary">Payment Status</th>
              <th scope="col" class="text-secondary">Mode of Transaction</th>
              <th scope="col" class="text-secondary">Delivery Status</th>
              <th scope="col" class="text-secondary">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result -> fetch_assoc()){?>
            <tr>
              <td class="text-secondary"><?php echo $row['transaction_id']; ?></td>
              <td class="text-secondary"><?php echo $row['cust_id']; ?></td>
              <td class="text-secondary"><?php 
                $c_id = $row['cust_id'];
                $sq = "SELECT name FROM customer WHERE cust_id = '$c_id'";
                $res = $conn -> query($sq);
                $ro = $res -> fetch_assoc();
                echo $ro['name'];
              ?></td>
              <td class="text-secondary">&#8377 <?php echo $row['amount']; ?></td>
              <td class="text-secondary"><?php echo $row['date']; ?></td>
              <td class="text-secondary"><?php echo $row['payment_status']; ?></td>
              <td class="text-secondary"><?php echo $row['Mode_of_transaction']; ?></td>
              <td class="text-secondary"><?php echo $row['Delivery_status']; ?></td>
              <td>
                <form action="admin_order.php" method="POST" class="d-inline">
                  <input type="hidden" name="order_id" value="<?php echo $row['order_id']?>">
                  <button type="submit" class="btn btn-secondary btn-sm" name="delete_order" value="Delete_order">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>

                <form action="admin_orderedit.php" method="POST" class="d-inline">
                  <input type="hidden" name="order_id" value="<?php echo $row['order_id']?>">
                  <button type="submit" class="btn btn-secondary btn-sm" name="edit_order" value="Edit_order">
                      <i class="fas fa-pen-square"></i>
                  </button>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
        }
        ?>
      </div>
      <!--  Order list Ends-->

    </div>    
    <!-- Main content of Order List ends here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->