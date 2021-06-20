<!-- Include header for admin -->
<?php include('./adminheader.php')?>
<!-- Include header for admin close-->

<!-- Include DataBase -->
<?php include('../dbConnection.php'); ?>

<?php
// Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }
?>

<div class="container-fluid">
  <div class="row mt-2">
    <!-- Include Sidebar -->
    <?php include('./adminsider.php')?>
    <!-- Include sidebar closed -->

    <!-- Php code for inserting item data starts here -->
    <?php
      if(isset($_POST['AddItemBtn'])){
        // Checking for empty fields
        if(isset($_POST['item_name']) && isset($_POST['item_size']) && isset($_POST['item_price']) && isset($_POST['item_s_price']) && isset($_POST['item_quantity']) && isset($_POST['item_category']) && isset($_POST['item_sub_category']) && isset($_POST['item_brand']) && isset($_POST['item_description']) && isset($_FILES['item_image']['name'])){
          $item_name = $_POST['item_name'];
          $item_size = $_POST['item_size'];
          $item_price = $_POST['item_price'];
          $item_s_price = $_POST['item_s_price'];
          $item_quantity = $_POST['item_quantity'];
          $item_category = $_POST['item_category'];
          $item_sub_category = $_POST['item_sub_category'];
          $item_brand = $_POST['item_brand'];
          $item_description = $_POST['item_description'];
        
          $item_image = $_FILES['item_image']['name'];
          $item_image_temp = $_FILES['item_image']['tmp_name'];
          $img_folder = '../image/item/'.$item_image;
          move_uploaded_file($item_image_temp, $img_folder);
        
          $sql = "INSERT INTO item(name, size, price, s_price, quantity, category, sub_category, brand, description, image) VALUES('$item_name', '$item_size', '$item_price', '$item_s_price', '$item_quantity', '$item_category', '$item_sub_category', '$item_brand', '$item_description', '$img_folder')";
        
          if($conn -> query($sql) == TRUE){
            $msg="<small class='alert alert-success'>Item Added Successfully !</small>";
          }
          else{
            $msg="<small class='alert alert-danger'>Unable to Add Item !</small>";
          }
        }else{
          $msg="<small class='alert alert-danger'>Fill All Fields !</small>";
        }
      }
      ?>
      <!-- Php code for inserting item data ends here -->
  
    <!-- Main Content of Edit Order starts here -->
    <div class="container-fluid col-sm-9">
      <div class="container-fluid">
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Add Item</h2>
      </div>
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 jumbotron">
        <form id="add_item_form" method="POST" enctype="multipart/form-data" action="Add_item.php">
                  <div class="mb-1">
                    <label for="item_name" class="form-label text-secondary">Item Name</label>
                    <input type="text" class="form-control form-control-sm" id="item_name" name="item_name" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_size" class="form-label text-secondary">Item Size</label>
                    <input type="text" class="form-control form-control-sm" id="item_size" name="item_size" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_price" class="form-label text-secondary">Price</label>
                    <small id="item_price_msg"></small>
                    <input type="text" class="form-control form-control-sm" id="item_price" name="item_price" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_selling_price" class="form-label text-secondary">Selling Price</label>
                    <small id="item_s_price_msg"></small>
                    <input type="text" class="form-control form-control-sm" id="item_s_price" name="item_s_price" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_quantity" class="form-label text-secondary">Quantity</label>
                    <small id="item_qty_msg"></small>
                    <input type="text" class="form-control form-control-sm" id="item_quantity" name="item_quantity" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_category" class="form-label text-secondary">Select Category</label>
                    <select name="item_category" id="item_category" class="form-control form-control-sm" required>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="kids">Kids</option>        
                    </select>
                  </div>
                  <div class="mb-1">
                    <label for="item_sub_category" class="form-label text-secondary">Select SubCategory</label>
                    <select name="item_sub_category" id="item_sub_category" class="form-control form-control-sm" required>
                        <option value="shoes">Shoes</option>
                        <option value="slippers">Slippers</option>
                        <option value="sandals">Sandals</option>        
                    </select>
                  </div>
                  <div class="mb-1">
                    <label for="item_brand" class="form-label text-secondary">Brand</label>
                    <input type="text" class="form-control form-control-sm" id="item_brand" name="item_brand" required>
                  </div>
                  <div class="mb-1">
                    <label for="item_description" class="form-label text-secondary">Description</label>
                    <textarea name="item_description" id="item_description" cols="30" rows="3" class="form-control form-control-sm" required></textarea>
                  </div>
                  <div class="mb-1">
                    <label for="profilepic" class="form-label">Item Image</label>
                    <input class="form-control form-control-sm" id="item_image" name="item_image" type="file" value=" " required>
                  </div>        
                  <div class="modal-footer">
                    <small id="item_msg"><?php if(isset($msg)){ echo $msg; } ?></small>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearAddItemFormWhileCancel()">Close</button>
                    <button type="submit" name="AddItemBtn" id="AddItemBtn" class="btn btn-primary">Add Item</button>
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
<?php include('./adminfooter.php')?>
<!-- Include footer for admin close-->