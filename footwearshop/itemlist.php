<!-- Include header -->
<?php
  include('header.php');
?>
<!-- Include header Closed -->

<!-- Include databse -->
<?php
  include('dbConnection.php');
?>
<!-- Include databse Closed -->

<?php
  if(isset($_POST['SearchItem'])){
    $brand = $_POST['brand'];
    $sql = "SELECT * FROM item WHERE brand = '$brand' AND quantity > 0";
    $result = $conn -> query($sql);
  }else{
    if($_GET['type'] == 'AllItems'){
      $sql = "SELECT * FROM item WHERE quantity > 0";
    }
    else if($_GET['type'] == 'MenShoes'){
      $sql = "SELECT * FROM item WHERE category = 'men' AND sub_category = 'shoes' AND quantity > 0";
    }
    else if($_GET['type'] == 'MenSlippers'){
      $sql = "SELECT * FROM item WHERE category = 'men' AND sub_category = 'slippers' AND quantity > 0";
    }
    else if($_GET['type'] == 'MenSandals'){
      $sql = "SELECT * FROM item WHERE category = 'men' AND sub_category = 'sandals' AND quantity > 0";
    }
    else if($_GET['type'] == 'WomenShoes'){
      $sql = "SELECT * FROM item WHERE category = 'women' AND sub_category = 'shoes' AND quantity > 0";
    }
    else if($_GET['type'] == 'WomenSandals'){
      $sql = "SELECT * FROM item WHERE category = 'women' AND sub_category = 'sandals' AND quantity > 0";
    }
    else if($_GET['type'] == 'WomenSlippers'){
      $sql = "SELECT * FROM item WHERE category = 'women' AND sub_category = 'slippers' AND quantity > 0";
    }
    else if($_GET['type'] == 'KidsShoes'){
      $sql = "SELECT * FROM item WHERE category = 'kids' AND sub_category = 'shoes' AND quantity > 0";
    }
    else if($_GET['type'] == 'KidsSlippers'){
      $sql = "SELECT * FROM item WHERE category = 'kids' AND sub_category = 'slippers' AND quantity > 0";
    }
    else if($_GET['type'] == 'KidsSandals'){
      $sql = "SELECT * FROM item WHERE category = 'kids' AND sub_category = 'sandals' AND quantity > 0";
    }
    else if($_GET['type'] == 'MenAll'){
      $sql = "SELECT * FROM item WHERE category = 'men' AND quantity > 0";
    }
    else if($_GET['type'] == 'WomenAll'){
      $sql = "SELECT * FROM item WHERE category = 'women' AND quantity > 0";
    }
    else if($_GET['type'] == 'KidsAll'){
      $sql = "SELECT * FROM item WHERE category = 'kids' AND quantity > 0";
    }
    $result = $conn -> query($sql);
  } 

?>

<div class="container-fluid bg-light">
  <h2 class="text-center fw-bold pt-4 pb-4 text-secondary" style="font-family: 'Ubuntu', sans-serif;">Your Results</h2>
  <p class="text-muted text-center pb-2">Click on image to view the item</p> 
  <div>
  <div class="row row-cols-1 row-cols-sm-4 g-4 bg-white mt-2">        
        <?php 
          if($result -> num_rows > 0){
          while($row = $result -> fetch_assoc()){
        ?>
          <div class="col">
          <a href="item.php?item_id=<?php echo $row['item_id']; ?>" class="text-dark" style="text-decoration:none;">
            <div class="card h-100">
              <img src="<?php echo str_replace('..','.',$row['image']); ?>" class="card-img-top" alt="...">
              <div class="card-body">
              <h5 class="card-title"><?php echo $row['name']; ?></h5>
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

                <p class="card-text d-inline-block">
                    Rating : <?php if(isset($val)){echo $val; }?>
                    <br>
                    Price : 
                    <small>
                      <del>&#8377 <?php echo $row['price']; ?></del>
                    </small>
                    <span class="font-weight-bolder fw-bold">&#8377 <?php echo $row['s_price']; ?></span> <br>
                    Size : 
                    <small>
                    <?php echo $row['size']; ?>
                    </small> 
                    <br><small class="text-muted"><?php echo $row['quantity']; ?> pairs available</small>
                </p>
              </div>
              <div class="card-footer">
                <div class="d-inline">
                  <a href="item.php?item_id=<?php echo $row['item_id']; ?>" class="btn btn-warning">Cart</a>
                </div>
                <div class="d-inline">
                  <a href="item.php?item_id=<?php echo $row['item_id']; ?>" class="btn btn-primary">Wishlist</a>
                </div>
              </div>
            </div>
            </a>
          </div>
         <?php 
         } 
          }else{
            echo '<h2 class="text-centre text-secondary">No Items Found </h2>';  
          }
         ?>
        </div>
  </div>


</div>
<!-- Include Footer -->
<?php
  include('footer.php');
?>
<!-- Include header Footer -->