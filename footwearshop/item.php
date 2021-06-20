<!-- Include header -->
<?php
  include('header.php');

  //Include database
  include_once('dbConnection.php');

  // Adding Review
  if(isset($_POST['review_btn'])){
    $cust_id = $_POST['cust_id'];
    $item_id = $_POST['item_id'];
    $item_rating = $_POST['item_rating'];
    $item_review = $_POST['item_review'];

    $sql = "INSERT INTO review (item_id, cust_id, item_review, rating) VALUES ('$item_id', '$cust_id', '$item_review','$item_rating')";

    if($conn -> query($sql) == TRUE){
      $wish_msg = "<h5 class='text-center text-success mb-2'>Thank You, for your review... </h5>";      
    }
    else{
      $wish_msg = "<h5 class='text-center text-danger mb-2'>Something went wrong, Unable to add to Review</h5>";
    }
  }

  // Adding in Wishlist
  if(isset($_POST['addwishlist'])){
    if(!isset($_SESSION['is_signin'])){
      $wish_msg = "<h5 class='text-center text-warning mb-2'>Please SignIn, if you are new here then SignUp</h5>";
    }else{
      $item_id = $_POST['item_id'];
      $cust_email = $_SESSION['cust_email_signin'];
      $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $cust_id = $row['cust_id'];

      $sql3 = "SELECT * FROM wishlist WHERE item_id='".$item_id."' AND cust_id='".$cust_id."'";
      $result3 = $conn -> query($sql3);
      $sql2 = "INSERT INTO wishlist (cust_id, item_id) VALUES('$cust_id', '$item_id')";
        if($conn -> query($sql2) == TRUE){
          $wish_msg = "<h5 class='text-center text-success mb-2'>Successfully Added To Wishlist</h5>";
        }else{
          $wish_msg = "<h5 class='text-center text-danger mb-2'>Something went wrong, Unable to add to wishlist</h5>";
        }      
    }
  }

  // Remove from wishlist DELETE
  if(isset($_POST['removewishlist'])){
      $item_id = $_POST['item_id'];
      $cust_email = $_SESSION['cust_email_signin'];
      $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $cust_id = $row['cust_id'];
  
      $sql2 = "DELETE FROM wishlist WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";
      $result2 = $conn -> query($sql2);

      if($conn -> query($sql2) == TRUE){
        $wish_msg = "<h5 class='text-center text-success mb-2'>Successfully Removed From Wishlist</h5>";
      }else{
        $wish_msg = "<h5 class='text-center text-danger mb-2'>Something went wrong, Unable to Remove From wishlist</h5>";
      }        
  }


  // Adding in Cart
  if(isset($_POST['addcart'])){
    if(!isset($_SESSION['is_signin'])){
      $wish_msg = "<h5 class='text-center text-warning mb-2'>Please SignIn, if you are new here then SignUp</h5>";
    }else{
      $item_id = $_POST['item_id'];
      $qty = $_POST['qty_entered'];
      $cust_email = $_SESSION['cust_email_signin'];
      $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $cust_id = $row['cust_id'];

      $sql3 = "SELECT * FROM cart WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";
      $result3 = $conn -> query($sql3);
      $num = $result3->num_rows;
      if($num == 0){
        $sql2 = "INSERT INTO cart (cust_id, item_id, quantity) VALUES('$cust_id', '$item_id', '$qty')";
        if($conn -> query($sql2) == TRUE){
          $wish_msg = "<h5 class='text-center text-success mb-2'>Successfully Added To Cart</h5>";
        }else{
          $wish_msg = "<h5 class='text-center text-danger mb-2'>Something went wrong, Unable to add to Cart</h5>";
        }
      }else{
        $sql2 = "UPDATE cart SET cust_id='$cust_id', item_id='$item_id', quantity='$qty' WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";

        $result2 = $conn -> query($sql2);
        if($conn -> query($sql2) == TRUE){
          $wish_msg = "<h5 class='text-center text-success mb-2'>Cart item Updated Successfully...</h5>";
        }else{
          $wish_msg = "<h5 class='text-center text-danger mb-2'>Something went wrong, Unable to add to Cart</h5>";
        }
      }      
    }
  }
  
  // Code to fetch data
  if(isset($_GET['item_id']) || isset($_POST['item_id'])){      
    if(isset($_GET['item_id']))
      $item_id = $_GET['item_id'];
    else
      $item_id = $_POST['item_id'];
    $sql = "SELECT * FROM item where item_id = $item_id";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
  }
?>

<!-- Include header Closed -->
<div class="container-fluid bg-light">
<h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Item Details</h2>
</div>

<div class="container">

  <div>
    <?php if(isset($wish_msg)){echo $wish_msg; }?>
  </div>

  <div class="row">
    <div class="col-sm-5">
      <img src="<?php echo str_replace('..','.',$row['image']); ?>" alt="pic" class="img-fluid card-img">
    </div>
    <div class="col-sm-7">
      <h4 class="text-secondary text-center fw-bold" style="font-family: 'Ubuntu', sans-serif;"><?php echo $row['name']; ?></h4>
      <p class="card-text d-inline-block">
                    <b>Price : </b>
                    <small>
                      <del>&#8377 <?php echo $row['price']; ?></del>
                    </small>
                    <span class="font-weight-bolder fw-bold">&#8377 <?php echo $row['s_price']; ?></span> <br>
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
                    <b>Rating :</b> <?php if(isset($val)){echo $val; }?>
                    <br>
                    <b>Size : </b>
                    <small>
                    <?php echo $row['size']; ?>
                    </small> 
      </p>
      <p class="">
        <b>Description : </b>
        <small><?php echo $row['description']; ?></small>
      </p>
      <p>
         <form action="" method="POST">
          <div class="row g-3 align-items-center">
            <div class="col-auto">
              <label for="quantity" class="col-form-label"><b>Quantity : </b></label>
            </div>
            <div class="col-auto">
              <input type="number" name="qty_entered" id="qty_entered" value="2" class="form-control">
              <small id="qtyMsg"></small>
            </div>
          </div>
          <small class="text-muted d-inline-block mt-2"><?php echo $row['quantity']; ?> pairs available</small>

          <input type="hidden" name="qty_avl" id="qty_avl" value=<?php echo $row['quantity']; ?>>
          <input type="hidden"  name="item_id" id="item_id_cart" value=<?php echo $row['item_id']; ?>>
                  
        
                        <!-- Cart Button -->
                <div class="d-grid gap-2 col-6 mx-auto">
                  <button type="submit" id="addcart" name="addcart" class="btn btn-warning d-block mt-4">Cart</button>
                </div>

          <?php
            if(isset($_SESSION['is_signin'])){
              $cust_email = $_SESSION['cust_email_signin'];
              $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
              $result = $conn -> query($sql);
              $row = $result -> fetch_assoc();
              $cust_id = $row['cust_id'];

              $sql2 = "SELECT * FROM wishlist WHERE cust_id='".$cust_id."' AND item_id='".$item_id."'";
              $result2 = $conn -> query($sql2);
              $num = $result2->num_rows;
              if($num>0){
                ?>
                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" id="removewishlist" name="removewishlist" class="btn btn-primary d-block mt-4">Remove form Wishlist</button>
                  </div>
                <?php
              }else{
                ?>
                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" id="addwishlist" name="addwishlist" class="btn btn-primary d-block mt-4">Wishlist</button>
                  </div>      
                <?php
              }
            }else{
              ?>
                <div class="d-grid gap-2 col-6 mx-auto">
                  <button type="submit" id="addwishlist" name="addwishlist" class="btn btn-primary d-block mt-4">Wishlist</button>
                </div>  
              <?php
            }     
          ?>
         </form> 
      </p>
      
    </div>
  </div>
</div><hr class="mt-3">

<!-- Review Section starts -->
<?php if(isset($_SESSION['is_signin'])){ ?>
<div class="container">
  <div class="row">
  <h3 class="text-muted text-center" style="font-family: 'Ubuntu', sans-serif;">Please Review Here</h3>
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <form action="" method="POST">
                        <input type="hidden" name="item_id" value=<?php echo $item_id; ?>>
                        <?php
                         $email = $_SESSION['cust_email_signin'];
                         $s = "SELECT cust_id FROM customer WHERE email = '$email'";
                         $r = $conn -> query($s);
                         $ro = $r -> fetch_assoc();
                         $c_id = $ro['cust_id'];
                        ?>
                        <input type="hidden" name="cust_id" value=<?php echo $c_id; ?>>
          <div>
            <label for="rating" class="form-label text-secondary">Rating</label>
            <input type="number" class="form-control form-control-sm" name="item_rating" id="item_rating" required>
            <span id="ratingMsg"></span>
          </div>
          <div class="mt-2">
            <label for="review" class="form-label text-secondary">Review</label>
            <textarea name="item_review" id="item_review" class="form-control form-control-sm" cols="30" rows="2" required></textarea>
          </div>
          <div class="mt-2">
            <button type="submit" name="review_btn" id="review_btn" value="review_btn" class="btn btn-sm btn-primary">Add Review</button>
          </div>
        </form>
    </div>            
    <div class="col-sm-3"></div>
  </div>  
</div><hr class="mt-3">
<!-- Review Section Ends -->
<?php } ?>
<!--Showcase Review Section start -->
<div class="container mt-2">
  <h3 class="text-muted text-center" style="font-family: 'Ubuntu', sans-serif;">Reviews</h3>
  <?php
    $sql = "SELECT * FROM review WHERE item_id = $item_id";
    $result = $conn -> query($sql);
    if($result -> num_rows < 1){
      echo '<h4 class="text-center text-secondary">No Reviews yet...! </h4>';  
    }else{
      while($row = $result -> fetch_assoc()){
        ?>
        <p>
          <?php
            $cust_id = $row['cust_id'];
            $sq = "SELECT name, image FROM customer WHERE cust_id = $cust_id";
            $res = $conn -> query($sq);
            $r = $res -> fetch_assoc();
          ?>
          <img src="<?php echo str_replace('..','.',$r['image']); ?>" alt="pic" class="reviewPic">
            <b class="text-muted"><?php echo $r['name']; ?></b>
          <br>
          <small class="text-muted"><b>Rating : </b><?php echo $row['rating']; ?> /10</small><br>
          <small class="text-secondary"><?php echo $row['item_review']; ?></small>

        </p><hr class="text-muted">
      <?php }?>
    <?php } ?>
  

</div>
<!-- Review close -->


<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->