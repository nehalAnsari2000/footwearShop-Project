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
  
    <!-- Code for deletion  -->
    <?php 
      if(isset($_POST['delete_item'])){
        $sql = "DELETE FROM item WHERE item_id = {$_POST['item_id']}";
        $result = $conn -> query($sql);
      }
    ?>
    <!-- Code for deletion ends -->

    <!-- Main Content of ItemList starts here -->
    <div class="container-fluid col-sm-9">

      <!-- Header serch bar and heading start -->
      <div class="row bg-light">
        <div class="col-sm-5 text-center">
          <h2 class="fw-bold text-secondary mt-1" style="font-family: 'Ubuntu', sans-serif;">Item List</h2>     
        </div>
        <div class="col-sm-7">
          <form class="d-flex" method="POST" action="adminitemlist.php">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search by Brand" name="search" aria-label="Search" required>
            <button class="btn btn-outline-secondary" name="search_item" value="Search" type="submit">Search</button>
          </form>
        </div>
      </div>
      <!-- Header serch bar and heading Ends -->

      <!--  Item list start-->
      <div class="mt-3">
      <?php
        if(isset($_POST['search'])){
          $brand = $_POST['search'];
          $sql = "SELECT * FROM item WHERE brand = '$brand'";          
          $result = $conn -> query($sql);
        }else{
          if($_GET['category'] == 'all'){
            $sql = "SELECT * FROM item";
          } 
          else if($_GET['category'] == 'men'){
            $sql = "SELECT * FROM item WHERE category = 'men'";
          }
          else if($_GET['category'] == 'women'){
            $sql = "SELECT * FROM item WHERE category = 'women'";
          }
          else if($_GET['category'] == 'kids'){
            $sql = "SELECT * FROM item WHERE category = 'kids'";
          }
          $result = $conn -> query($sql);
        }
        // $result = $conn -> query($sql);
        if($result -> num_rows > 0){
      ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-secondary">Image</th>
              <th scope="col" class="text-secondary">ID</th>
              <th scope="col" class="text-secondary">Name</th>
              <th scope="col" class="text-secondary">Size</th>
              <th scope="col" class="text-secondary">price</th>
              <th scope="col" class="text-secondary">Selling</th>
              <th scope="col" class="text-secondary">Qty</th>
              <th scope="col" class="text-secondary">Category</th>
              <th scope="col" class="text-secondary">SubCtgry</th>
              <th scope="col" class="text-secondary">Brand</th>
              <th scope="col" class="text-secondary">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result -> fetch_assoc()){?>
            <tr>
              <td>
                <img src="<?php echo $row['image']; ?>" alt="pic" style="max-width:80px;" class="img-fluid rounded">
              </td>
              <td class="text-secondary"><?php echo $row['item_id']; ?></td>
              <td class="text-secondary"><?php echo $row['name']; ?></td>
              <td class="text-secondary"><?php echo $row['size']; ?></td>
              <td class="text-secondary"><?php echo $row['price']; ?></td>
              <td class="text-secondary"><?php echo $row['s_price']; ?></td>
              <td class="text-secondary"><?php echo $row['quantity']; ?></td>
              <td class="text-secondary"><?php echo $row['category']; ?></td>
              <td class="text-secondary"><?php echo $row['sub_category']; ?></td>
              <td class="text-secondary"><?php echo $row['brand']; ?></td>
              <td>
                <form action="" method="POST" class="d-inline">
                  <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                  <button type="submit" name="delete_item" value="Delete" class="btn btn-secondary btn-sm">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
                <form action="admin_edititem.php" method="POST" class="d-inline">
                  <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                  <button type="submit" name="edit_item" value="Edit" class="btn btn-secondary btn-sm">
                  <i class="fas fa-pen-square"></i>
                  </button>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php 
        }else{
          echo "<h3 class='text-secondary text-centre'>No Items</h3>";
        }
        ?>
      </div>
      <!--  Item list Ends-->

    </div>    
    <!-- Main content of ItemList is end here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->