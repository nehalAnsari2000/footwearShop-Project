<?php
// Redirect if admin tries to acces this page without login
// if(!isset($_SESSION['is_admin_signin'])){
//   echo "<script>location.href='../index.php'</script>";
// }
?>
<div class="col-sm-3 border border-3 rounded bg-light">
      <div class="text-center mt-5">
        <a href="adminindex.php" class="fs-5 sidebar">Admin</a>
      </div><hr>
      <div class="text-center mt-3">
          <a class="nav-link dropdown-toggle sidebar fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Items
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item text-secondary" href="adminitemlist.php?category=men">Men</a></li>
            <li><a class="dropdown-item text-secondary" href="adminitemlist.php?category=women">Women</a></li>
            <li><a class="dropdown-item text-secondary" href="adminitemlist.php?category=kids">Kids</a></li>
            <li><hr class="dropdown-divider text-secondary"></li>
            <li><a class="dropdown-item text-secondary" href="adminitemlist.php?category=all">All</a></li>
          </ul>
      </div><hr>
      <div class="text-center mt-3">
        <a href="admin_customerlist.php" class="fs-5 sidebar">Customers</a>
      </div><hr> 
      <div class="text-center mt-3">
        <a href="admin_order.php" class="fs-5 sidebar">Orders</a>
      </div><hr>
      <div class="text-center mt-3">
        <a href="create_admin.php" class="fs-5 sidebar">Create Admin</a>
      </div><hr>
      <div class="text-center mt-3">
        <a href="add_customer.php" class="fs-5 sidebar">Add Customer</a>
      </div><hr>    
      <div class="text-center mt-3">
        <a href="Add_item.php" class="fs-5 sidebar">Add Items</a>
      </div><hr>
      <div class="text-center mt-3">
        <a href="../logout.php" class="fs-5 sidebar">Logout</a>
      </div>
    </div>

