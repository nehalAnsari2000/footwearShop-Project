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

    <!--Code for editing tha data  -->
    <?php
      if(isset($_POST['edit'])){
        
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_size = $_POST['item_size'];
        $item_price = $_POST['item_price'];
        $item_s_price = $_POST['item_s_price'];
        $item_qty = $_POST['item_qty'];
        $item_category = $_POST['item_category'];
        $item_sub_category = $_POST['item_sub_category'];
        $item_brand = $_POST['item_brand'];
        $item_description = $_POST['item_description'];

        $item_image = $_FILES['item_image']['name'];
        $item_image_temp = $_FILES['item_image']['tmp_name'];
        $img_folder = '../image/item/'.$item_image;
        move_uploaded_file($item_image_temp, $img_folder);

        $sql = "UPDATE item SET item_id = '$item_id', name = '$item_name', size = '$item_size', price = '$item_price', s_price = '$item_s_price', quantity = '$item_qty', category = '$item_category', sub_category = '$item_sub_category', brand = '$item_brand', description = '$item_description', image = '$img_folder' WHERE item_id = '$item_id'";

        if($conn -> query($sql)==TRUE){
          $msg = "<small class='alert alert-success'>Updated successfully !</small>";
          $sql = "SELECT * FROM item WHERE item_id = {$_POST['item_id']}";
          $result = $conn -> query($sql);
          $row = $result -> fetch_assoc();
        }else{
          $msg = "<small class='alert alert-danger'>Can't update ! !</small>";
        }
      }
    ?>
    <!--Code for editing tha data ends  -->
    
    <!-- Code for fetching the data from item table -->
    <?php 
      if(isset($_POST['edit_item'])){
        $sql = "SELECT * FROM item WHERE item_id = {$_POST['item_id']}";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();
      }
    ?>
    <!-- Code for fetching the data from item table ends -->

    <!-- Main Content of Edit Item starts here -->
    <div class="container-fluid col-sm-9">
      <div class="container-fluid">
        <h2 class="fw-bold text-secondary mt-1 text-center" style="font-family: 'Ubuntu', sans-serif;">Edit Item</h2>
      </div>
      <div class="container-fluid row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="text-center">
              <img src="<?php if(isset($row['image'])){echo $row['image']; } ?>" alt="pic" style="max-width:150px" class="img-fluid img-thumbnail">
            </div>
            <form method="POST" action="admin_edititem.php" enctype="multipart/form-data" >
                  <div class="mt-2">
                    <label for="item_id" class="form-label text-secondary">Item ID</label>
                    <input type="text" class="form-control form-control-sm" id="item_id" name="item_id" value="<?php if(isset($row['item_id'])){echo $row['item_id']; } ?>" readonly>
                  </div>
                  <div class="mt-3">
                    <label for="item_name" class="form-label text-secondary">Item Name</label>
                    <input type="text" class="form-control form-control-sm" id="item_name" name="item_name" value="<?php if(isset($row['name'])){echo $row['name']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_size" class="form-label text-secondary">Item Size</label>
                    <input type="text" class="form-control form-control-sm" id="item_size" name="item_size" value="<?php if(isset($row['size'])){echo $row['size']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_price" class="form-label text-secondary">Price</label>
                    <input type="text" class="form-control form-control-sm" id="item_price" name="item_price" value="<?php if(isset($row['price'])){echo $row['price']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_selling_price" class="form-label text-secondary">Selling Price</label>
                    <input type="text" class="form-control form-control-sm" id="item_s_price" name="item_s_price" value="<?php if(isset($row['s_price'])){echo $row['s_price']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_quantity" class="form-label text-secondary">Quantity</label>
                    <input type="text" class="form-control form-control-sm" id="item_qty" name="item_qty" value="<?php if(isset($row['quantity'])){echo $row['quantity']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_category" class="form-label text-secondary">Select Category</label>
                    <select name="item_category" id="item_category" value="<?php if(isset($row['category'])){echo $row['category']; } ?>" class="form-control form-control-sm" required>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="kids">Kids</option>        
                    </select>
                  </div>
                  <div class="mt-3">
                    <label for="item_sub_category" class="form-label text-secondary">Select SubCategory</label>
                    <select name="item_sub_category" id="item_sub_category" value="<?php if(isset($row['sub_category'])){echo $row['sub_category']; } ?>" class="form-control form-control-sm" required>
                        <option value="shoes">Shoes</option>
                        <option value="slippers">Slippers</option>
                        <option value="sandals">Sandals</option>        
                    </select>
                  </div>
                  <div class="mt-3">
                    <label for="item_brand" class="form-label text-secondary">Brand</label>
                    <input type="text" class="form-control form-control-sm" id="item_brand" name="item_brand" value="<?php if(isset($row['brand'])){echo $row['brand']; } ?>" required>
                  </div>
                  <div class="mt-3">
                    <label for="item_description" class="form-label text-secondary">Description</label>
                    <textarea name="item_description" id="item_description" class="form-control form-control-sm" cols="" rows="2" required><?php if(isset($row['description'])){echo $row['description']; } ?></textarea>
                  </div>
                  <div class="mt-3">
                    <label for="profilepic" class="form-label">Item Image</label>
                    <input class="form-control form-control-sm" name="item_image" id="item_image" type="file" value=" " required>
                  </div>        
                  <div class="modal-footer">
                    <small><?php if(isset($msg)){echo $msg; } ?></small>
                    <button type="submit" name="edit" value="Edit" class="btn btn-primary">Edit</button>
                  </div>     
                </form>
        </div>
        <div class="col-sm-2"></div>
      </div>      
    </div>    
    <!-- Main content of Edit Item is end here -->
  </div>
</div>


<!-- Include footer for admin -->
<?php include('adminfooter.php')?>
<!-- Include footer for admin close-->