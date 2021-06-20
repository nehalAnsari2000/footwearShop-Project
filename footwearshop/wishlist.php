<!-- Include header -->
<?php
  include('header.php');

  include('dbConnection.php'); 

  // Code for deletion
  if(isset($_POST['deleteWishItem'])){
    $item_id = $_POST['item_id'];
    $cust_id = $_POST['cust_id'];
    $sql = "DELETE FROM wishlist WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";
    $conn->query($sql);
  }

  // Code to fetch data from wishlist to display the list
  $cust_email = $_SESSION['cust_email_signin'];
  $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
  $result = $conn -> query($sql);
  $ro = $result -> fetch_assoc();
  $cust_id = $ro['cust_id'];

  $sql2 = "SELECT item_id FROM wishlist WHERE cust_id='".$cust_id."'";
  $result2 = $conn -> query($sql2);
?>
<!-- Include header Closed -->
<div class="container-fluid bg-light">
  <h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Wishlist</h2>
  <p class="text-muted text-center pb-2">Click on image to view the item</p>
</div>
<div class="container">
  <?php
  if($result2 -> num_rows < 1){
    echo "<h4 class='text-center'>Wishlist is Empty...!</h4>";
  }
  ?>  
  <div class="row row-cols-1 row-cols-md-1 g-4">
    <?php 
      while($row = $result2->fetch_assoc()){ 
        $item_id = $row['item_id'];
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
            <h4 class="text-secondary fw-bold" style="font-family: 'Ubuntu', sans-serif;"><?php echo $row3['name']; ?></h4>
              <p class="card-text"><?php echo $row3['description']; ?></p>
              <p class="card-text">
              <?php 
                        $id = $row["item_id"];
                        $sq = "SELECT count(*) as n FROM review WHERE item_id='$id'";
                        $re = $conn -> query($sq);
                        $r = $re -> fetch_assoc();
                        $n = $r['n'];

                        if($n > 0){
                          $sq = "SELECT SUM(rating) as total FROM review WHERE item_id='$id'";
                          $re = $conn -> query($sq);
                          $r = $re -> fetch_assoc();
                          $sum = $r['total'];
                          $val = round($sum/$n, 1);
                        }else{
                          $val = '<small class="text-secondary"> No rating yet</small>';
                        }
                      ?>

                    Rating : <?php if(isset($val)){echo $val; }?>
                    <br>
                    Price : 
                    <small>
                      <del>&#8377 <?php echo $row3['price']; ?></del>
                    </small>
                    <span class="font-weight-bolder fw-bold">&#8377 <?php echo $row3['s_price']; ?></span> <br>
                    Size : 
                    <small>
                      <?php echo $row3['size']; ?>
                    </small> 
                    <br><small class="text-muted"><?php echo $row3['quantity']?> pairs available</small><br>
              </p>
              <form action="" method="POST">
                  <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                  <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                  <button type="submit" name="deleteWishItem" class="btn btn-danger">Remove</button>
              </form>
            
            </div>
          </div>
        </div>
      </div>
    
    </div>
    <?php } ?>
  </div>
  


 

</div>




<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->