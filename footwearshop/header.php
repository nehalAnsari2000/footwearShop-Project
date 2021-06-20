<?php
  if(!isset($_SESSION)){
    session_start();
  }
  include_once('dbConnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Font awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&           
  display=swap" rel="stylesheet">

  <title>footwearshop</title>
</head>
<body>
  <div class="container-fluid">

      <div class="fixed-top"> 
      <!-- Navigation Bar -->
      <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">footwearShop</a>
        <div class="">         
          <form class="d-flex" method="POST" action="itemlist.php">
            <input class="form-control me-2" type="search" name="brand" placeholder="Search by Brand" aria-label="Search" required>
            <button class="btn btn-outline-light" type="submit" name="SearchItem" value="Search">Search</button>
          </form>
        </div>
        </div>
        </nav>
        <!-- Navigation bar closed -->

        <!-- 2nd Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Men
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="itemlist.php?type=MenShoes">Shoes</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=MenSlippers">Slippers</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=MenSandals">Sandals</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Women
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="itemlist.php?type=WomenShoes">Shoes</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=WomenSlippers">Slippers</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=WomenSandals">Sandals</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kids
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="itemlist.php?type=KidsShoes">Shoes</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=KidsSlippers">Slippers</a></li>
                <li><a class="dropdown-item" href="itemlist.php?type=KidsSandals">Sandals</a></li>
              </ul>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="itemlist.php?type=AllItems">All Items</a>
            </li>
            <?php

             if(isset($_SESSION['is_signin'])){
              $email = $_SESSION['cust_email_signin'];
              $sql = "SELECT * FROM customer WHERE email = '$email'";
              $result = $conn -> query($sql);
              $row = $result -> fetch_assoc();
              ?>

              <li class="nav-item">
                <a class="nav-link" href="wishlist.php">Wishlist</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
                            
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo str_replace('..','.',$row['image']);?>" class="profilePic" alt="Profile">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item  text-secondary" href="profile.php"><b><?php echo $row['name'];?></b></a></li>
                <li><hr class="dropdown-divider text-secondary"></li>
                <li><a class="dropdown-item text-secondary" href="profile.php">View Profile</a></li>
                <li><a class="dropdown-item text-secondary" href="orderstatus.php">Your Orders</a></li>
                <li><hr class="dropdown-divider text-secondary"></li>
                <li><a class="dropdown-item text-secondary" href="logout.php">Logout</a></li>
              </ul>
            </li>
            <?php    
            }
            ?>
            
          </ul>
        </div>
        <?php
          if(!isset($_SESSION['is_signin'])){
            echo '
            <a href="signin.php" class="btn-primary btn btn" style="margin-right:5px;">Signin</a>
            <a href="signup.php" class="btn-primary btn btn" style="text-decoration:none">Signup</a>
            ';
          }
        ?>
      </div>
    </nav>
    <!-- 2nd Navbar Close -->
    </div>

    <!-- Empty div -->
    <div class="container-fluid bg-light" style="min-height: 150px;">
    </div>
    <!-- Empty div closed -->
