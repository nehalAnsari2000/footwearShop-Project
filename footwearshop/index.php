<!-- Include Header -->
<?php  include('header.php'); ?>
<!-- Include header closed -->

<!-- Include database -->
<?php  include('dbConnection.php'); ?>
<!-- Include database closed -->

    <!-- Main Content -->
    <div class="mainContent">

        <!-- For Men -->
        <h1 class="category mt-5 text-secondary">For Men</h1>
        <div class="row row-cols-1 row-cols-md-5 g-4">        
        <?php 
          $sql = "SELECT * FROM item WHERE category = 'men' AND quantity > 0 LIMIT 5";
          $result = $conn -> query($sql);
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
              <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-warning">Cart</a>
                </div>
                <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-primary">Wishlist</a>           
                </div>
              </div>
            </div>
            </a>
          </div>
         <?php
         }
        }else{
          echo '<h2 class="text-secondary text-centre">No Items Available For Men</h2>';
        }
         ?>
        </div>
        <div class="text-center m-4">
          <a href="itemlist.php?type=MenAll" class="btn btn-primary btn-sm">View All</a>
        </div>
        <hr>


        <!-- For Women -->
        <h1 class="category mt-5 text-secondary">For Women</h1>
        <div class="row row-cols-1 row-cols-md-5 g-4">        
        <?php 
          $sql = "SELECT * FROM item WHERE category = 'women' AND quantity > 0 LIMIT 5";
          $result = $conn -> query($sql);
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
              <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-warning">Cart</a>
                </div>
                <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-primary">Wishlist</a>           
                </div>
              </div>
            </div>
            </a>
          </div>
         <?php
         }
        }else{
          echo '<h2 class="text-secondary text-centre">No Items Available For Women</h2>';
        }
         ?>
        </div>
        <div class="text-center m-4">
          <a href="itemlist.php?type=WomenAll" class="btn btn-primary btn-sm">View All</a>
        </div>
        <hr>


        <!-- For Kids -->
        <h1 class="category mt-5 text-secondary">For Kids</h1>
        <div class="row row-cols-1 row-cols-md-5 g-4">        
        <?php 
          $sql = "SELECT * FROM item WHERE category = 'kids' AND quantity > 0 LIMIT 5";
          $result = $conn -> query($sql);
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
                <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-warning">Cart</a>
                </div>
                <div class="d-inline mb-0">
                  <a href="item.php?item_id=<?php echo $row['item_id'];?>" class="btn btn-primary">Wishlist</a>           
                </div>
              </div>
            </div>
            </a>
          </div>
         <?php
         }
        }else{
          echo '<h2 class="text-secondary text-centre">No Items Available For Kids</h2>';
        }
         ?>
        </div>
        <div class="text-center m-4">
          <a href="itemlist.php?type=KidsAll" class="btn btn-primary btn-sm">View All</a>
        </div>
        <hr>


    </div>
    <!-- Main Content Close -->
<?php include('footer.php')?>