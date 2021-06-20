<?php 
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");

  session_start();
  $amount = $_POST['amount'];
  $cust_id = $_POST['cust_id'];
  $cust_email = $_POST['cust_email'];
   if(!isset($_SESSION['cust_email_signin'])){
    $_SESSION['cust_email_signin'] = $cust_email;
    $_SESSION['cust_id'] = $cust_id;
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="GENERATOR" content="Evrsoft First Page">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>Checkout</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-6 offset-sm-3 jumbotron">
        <h3 class="mb-5">Welcome to footwearShop Payment Page </h3>
        <form action="./PaytmKit/pgRedirect.php" method="POST">

          <div class="form-group row mt-2">
            <label for="ORDER_ID" class="col-sm-4 col-form-label">Order Id</label>
            <div class="col-sm-8">
              <input type="text" id="ORDER_ID" class="form-control" tabindex='1' maxlength='20' size='20' name="ORDER_ID" autocomplete="off" value="<?php echo 'ORDS'.rand(10000,99999999) ?>" readonly>
            </div>
          </div>

          <div class="form-group row mt-2">
            <label for="CUST_ID" class="col-sm-4 col-form-label">Customer Id</label>
            <div class="col-sm-8">
              <input type="text" id="CUST_ID" class="form-control" tabindex='2' maxlength='12' size='12' name="CUST_ID" autocomplete="off" value="<?php if(isset($cust_id)){echo $cust_id; }?>" readonly>
            </div>
          </div>

          <div class="form-group row mt-2">
            <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
            <div class="col-sm-8">
              <input title="TXN_AMOUNT" type="text" id="TXN_AMOUNT" class="form-control" tabindex='10' maxlength='12' size='12' name="TXN_AMOUNT" value="<?php if(isset($amount)){echo $amount; }?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-8">
              <input type="hidden" id="INDUSTRY_TYPE_ID" class="form-control" tabindex='4' maxlength='12' size='12' name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-8">
              <input type="hidden" id="CHANNEL_ID" class="form-control" tabindex='4' maxlength='12' size='12' name="CHANNEL_ID" autocomplete="off" value="WEB" readonly>
            </div>
          </div>
          <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
          <input type="hidden" name="cust_email" value="<?php echo $cust_email; ?>">

          <div class="text-center mt-2">
            <input type="submit" value="Checkout" class="btn btn-primary">
            <a href="./cart.php" class="btn btn-secondary">Cancel</a>
          </div>

        </form>
        <small class="mt-2 form-text text-muted">Note: Complete Payment by Clicking Checkout Button</small>
      </div>
    </div>
  </div>
</body>
</html>