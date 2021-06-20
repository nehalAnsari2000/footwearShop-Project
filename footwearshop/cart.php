<!-- Include header -->
<?php
  session_start();
  include('header.php');

  include('dbConnection.php'); 

  // Code for deletion
  if(isset($_POST['cartremove'])){
    $item_id = $_POST['item_id'];
    $cust_id = $_POST['cust_id'];
    $sql = "DELETE FROM cart WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";
    $conn->query($sql);
  }

  // Code to fetch data from wishlist to display the list
  $cust_email = $_SESSION['cust_email_signin'];
  $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
  $result = $conn -> query($sql);
  $ro = $result -> fetch_assoc();
  $cust_id = $ro['cust_id'];

  $sql2 = "SELECT * FROM cart WHERE cust_id='".$cust_id."'";
  $result2 = $conn -> query($sql2);
?>


<div class="container-fluid bg-light">
<h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Cart</h2>
<p class="text-muted text-center pb-2">Click on image to view the item</p> 
</div>
<div class="container">  
  <?php
    if($result2 -> num_rows < 1){
      echo "<h4 class='text-center'>Cart is Empty...!</h4>";
    }
  ?>  

  <div class="row">
    <div class="col-sm-7">
    <div class="row row-cols-1 row-cols-md-1 g-4">
    <?php 
      while($row = $result2->fetch_assoc()){ 
        $item_id = $row['item_id'];
        $item_qty = $row['quantity'];
        $sql3 = "SELECT * FROM item WHERE item_id='".$item_id."'";
        $result3 = $conn -> query($sql3);
        $row3 = $result3 ->  fetch_assoc();
    ?>
    <div class="col">      
      <div class="card mb-3" style="max-width: auto">
        <div class="row g-0">
          <div class="col-sm-4">
            <a href="item.php?item_id=<?php echo $row3['item_id']; ?>" class="text-dark" style="text-decoration:none;">
              <img src="<?php echo str_replace('..','.',$row3['image']); ?>" alt="pic" class="card-img wishlistImage img-fluid img-thumbnail">
            </a>

          </div>
          <div class="col-sm-8">
            <div class="card-body">
              <h4 class="card-title"><?php echo $row3['name']; ?></h4>
              <p class="card-text">
                    Price : 
                    <small>
                      <del>&#8377 <?php echo $row3['price']; ?></del>
                    </small>
                    <span class="font-weight-bolder fw-bold">&#8377 <?php echo $row3['s_price']; ?></span> <br>
                    Size : 
                    <small>
                      <?php echo $row3['size']; ?>
                    </small> <br>
                    Pairs : 
                    <small class="text-dark"><?php echo $item_qty; ?></small>
                    <br><small class="text-muted"><?php echo $row3['quantity']?> pairs available</small><br>
              </p>
              <form action="" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                <button type="submit" name="cartremove" class="btn btn-danger">Remove</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    <?php } ?>
  </div>
  </div>

  <!-- Billing starts here -->
    <div class="col-sm-5 border">
      <h3 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Bill</h3>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Qty.</th>
              <th scope="col">Title</th>
              <th scope="col">Price</th>
              <th scope="col">Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php 
               $cust_email = $_SESSION['cust_email_signin'];
               $sql = "SELECT * FROM customer WHERE email = '".$cust_email."'";
               $result = $conn -> query($sql);
               $ro = $result -> fetch_assoc();
               $cust_id = $ro['cust_id'];
               $cust_address = $ro['address'];
               $cust_name = $ro['name'];

               $sql2 = "SELECT * FROM cart WHERE cust_id='".$cust_id."'";
               $result2 = $conn -> query($sql2);
               $total = 0;
              while($row = $result2->fetch_assoc()){ 
                $item_id = $row['item_id'];
                $item_qty = $row['quantity'];
                $sql3 = "SELECT * FROM item WHERE item_id='".$item_id."'";
                $result3 = $conn -> query($sql3);
                $row3 = $result3 ->  fetch_assoc();
                $s_price = $row3['s_price'];
                $amt = $s_price*$item_qty;
                $total = $total + $amt;
            ?>

            <tr>
              <td><?php echo $item_qty; ?></td>
              <td><?php echo $row3['name']; ?></td>
              <td>&#8377 <?php echo $row3['s_price']; ?></td>
              <td>&#8377 <?php echo $amt; ?></td>
            </tr>
          <?php }?>
          <tr>
            <td colspan="3" class="text-center fw-bold">Total Amount</td>
            <td class="fw-bold">&#8377 <?php echo $total; ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <?php if($total > 0){ ?>
      <div class="mt-5">
          <h4 class="text-center text-secondary">Deliver to <b><?php echo $cust_name; ?></b></h4>
          <p class="text-center text-secondary"><?php echo $cust_address; ?></p>
      </div>
      <div class="text-center mt-4">
            <form action="checkout.php" method="POST" class="mb-2">
                <input type="hidden" name="amount" value="<?php echo $total; ?>">
                <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                <input type="hidden" name="cust_email" value="<?php echo $cust_email; ?>">
                <button class="btn btn-primary" name="pay">Pay here</button>
            </form>

            <form action="checkout_cod.php" method="POST" class="mb-2">
                <input type="hidden" name="amount" value="<?php echo $total; ?>">
                <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                <input type="hidden" name="cust_email" value="<?php echo $cust_email; ?>">
                <button class="btn btn-warning" name="cod">Cash on Delivery</button>
            </form>
            
      </div>
      <?php } else{
        echo '<h4 class="text-center text-secondary">Add Something to Your Cart to Pay</b></h4>';
      }?>
    </div>
  </div>
</div>


<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->