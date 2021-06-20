<?php
session_start();
include('./dbConnection.php');
if(isset($_POST['cod'])){

  $cust_id = $_POST['cust_id'];
  $cust_email = $_POST['cust_email'];
  $amount = $_POST['amount'];
  $order_id = "ORDS" . rand(10000,99999999);
  $date = date("Y/m/d");
  $mode_of_transaction = "Offline";
  $delivery_status = "Not Delivered";
  $status = "TXN_SUCCESS";
  
  $sql = "INSERT INTO order_bill (transaction_id, cust_id, amount, payment_status, date, Mode_of_transaction, Delivery_status) VALUES('$order_id', '$cust_id', '$amount', '$status', '$date', '$mode_of_transaction', '$delivery_status')";

  if($conn -> query($sql) == TRUE){
    $sql = "DELETE FROM cart WHERE cust_id = '".$cust_id."'";
    $conn->query($sql);
    ?>
      <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="css/bootstrap.min.css">
          <title>Document</title>
        </head>
        <body>
          <div class="container">
            <div class="mt-5">
                <h1 class="text-center text-success">Thank You</h1>
                <h2 class="text-center text-success">Order Placed Successfully...</h2>
                <p class="text-center text-success">Redirecting...!</p>
                <?php 
                echo "<script> setTimeout(() => {
                  window.location.href = './index.php';
                }, 2000);
                </script>";
                ?>
              </div>
          </div>
        </body>
        </html>                
    <?php
  }else{
    echo "Something Went Wrong";
  }
}else{
  echo "Oops!";
}
?>

