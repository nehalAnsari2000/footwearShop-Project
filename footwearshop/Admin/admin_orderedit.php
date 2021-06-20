<!-- Include header for admin -->
<?php include('adminheader.php')?>
<!-- Include header for admin close-->

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

  <?php
  // Include database
  include('../dbConnection.php');

  //Code for updating order
  if(isset($_POST['edit_order_btn'])){
    $order_id = $_POST['order_id'];
    $order_date = $_POST['order_date'];
    $payment_status = $_POST['payment_status'];
    $mode_of_transaction = $_POST['mode_of_transaction'];
    $delivery_status = $_POST['delivery_status'];

    $sql = "UPDATE order_bill SET date = '$order_date', payment_status = '$payment_status', Mode_of_transaction = '$mode_of_transaction', Delivery_status = '$delivery_status'  WHERE order_id = '$order_id'";

    if($conn -> query($sql)==TRUE){
      $msg = "<small class='alert alert-success'>Updated successfully !</small>";
      $sql = "SELECT * FROM order_bill WHERE order_id = '$order_id'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
    }else{
      $msg = "<small class='alert alert-danger'>Can't update ! !</small>";
    }

  }

  // Code to fetch data 
  if(isset($_POST['edit_order'])){
    $order_id = $_POST['order_id'];
    $sql = "SELECT * FROM order_bill WHERE order_id = '$order_id'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
  }
  
  ?>


    <!-- Main Content of Edit Order starts here -->
    <div class="container-fluid col-sm-9">
      <div class="container-fluid">
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Edit Order</h2>
      </div>
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="admin_orderedit.php" enctype="multipart/form-data">
                  <div class="mt-2">
                    <label for="bill_id" class="form-label text-secondary">Order ID</label>
                    <input type="text" class="form-control form-control-sm" id="order_id" name="order_id" value="<?php if(isset($row['order_id'])){echo $row['order_id']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="cust_id" class="form-label text-secondary">Customer ID</label>
                    <input type="text" class="form-control form-control-sm" id="cust_id" name="cust_id" value="<?php if(isset($row['cust_id'])){echo $row['cust_id']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="cust_name" class="form-label text-secondary">Customer Name</label>
                    <input type="text" class="form-control form-control-sm" id="cust_name" name="cust_name" value=" <?php 
                      $c_id = $row['cust_id'];
                      $sq = "SELECT name FROM customer WHERE cust_id = '$c_id'";
                      $res = $conn -> query($sq);
                      $ro = $res -> fetch_assoc();
                      echo $ro['name'];
                    ?>
                    " readonly>
                  </div>
                  <div class="mt-3">
                    <label for="amount" class="form-label text-secondary">Amount</label>
                    <input type="text" class="form-control form-control-sm" id="order_amount" name="order_amount" value="<?php if(isset($row['amount'])){echo $row['amount']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="date" class="form-label text-secondary">Date</label>
                    <input type="date" class="form-control form-control-sm" id="order_date" name="order_date" value="<?php if(isset($row['date'])){echo $row['date']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="payment_status" class="form-label text-secondary">Payment Status</label>
                    <input type="text" class="form-control form-control-sm" id="payment_status" name="payment_status" value="<?php if(isset($row['payment_status'])){echo $row['payment_status']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="ModeofTransation" class="form-label text-secondary">Mode of Transaction</label>
                    <input type="text" class="form-control form-control-sm" id="mode_of_transaction" name="mode_of_transaction" value="<?php if(isset($row['Mode_of_transaction'])){echo $row['Mode_of_transaction']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="DeliveryStatus" class="form-label text-secondary">Delivery Status</label>
                    <input type="text" class="form-control form-control-sm" id="delivery_status" name="delivery_status" value="<?php if(isset($row['Delivery_status'])){echo $row['Delivery_status']; } ?>" required>
                  </div>
                  <div class="modal-footer">
                    <small><?php if(isset($msg)){echo $msg; } ?></small>
                    <button type="submit" name="edit_order_btn" value="Edit" class="btn btn-primary">Edit</button>
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
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->