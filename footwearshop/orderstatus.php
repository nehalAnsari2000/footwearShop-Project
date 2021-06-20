<!-- Include header -->
<?php
  include('header.php');
?>
<!-- Include header Closed -->

<div class="container-fluid bg-light">
<h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Orders</h2>
</div>
<div class="container">

       <!--  Order list start-->
       <div class="table-responsive mt-3">
       
        <?php
          $email = $_SESSION['cust_email_signin'];
          $sql = "SELECT cust_id FROM customer WHERE email = '$email'";
          $result = $conn -> query($sql);
          $row = $result -> fetch_assoc();
          $cust_id = $row['cust_id'];

          $sql = "SELECT * FROM order_bill WHERE cust_id = $cust_id";
          $result = $conn -> query($sql);

          if($result -> num_rows > 0){
        ?>

        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-secondary">Order ID</th>
              <th scope="col" class="text-secondary">Amount</th>
              <th scope="col" class="text-secondary">Date</th>
              <th scope="col" class="text-secondary">Payment Status</th>
              <th scope="col" class="text-secondary">Mode of Transaction</th>
              <th scope="col" class="text-secondary">Delivery Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result -> fetch_assoc()){ ?>
            <tr>
              <td class="text-secondary"><?php echo $row['order_id']; ?></td>
              <td class="text-secondary">&#8377 <?php echo $row['amount']; ?></td>
              <td class="text-secondary"><?php echo $row['date']; ?></td>
              <td class="text-secondary"><?php echo $row['payment_status']; ?></td>
              <td class="text-secondary"><?php echo $row['Mode_of_transaction']; ?></td>
              <td class="text-secondary"><?php echo $row['Delivery_status']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
          }else{
            echo '<h4 class="text-center text-secondary">No Orders yet...! </h4>';  
          }
        ?>
      </div>
      <!--  Order list Ends-->
</div>

<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->