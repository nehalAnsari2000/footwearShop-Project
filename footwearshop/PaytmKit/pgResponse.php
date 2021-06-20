<?php

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include_once('../dbConnection.php');
session_start();
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.

		if(isset($_POST['ORDERID']) && isset($_POST['TXNAMOUNT'])){
			$order_id = $_POST['ORDERID'];
			$status = $_POST['STATUS'];
			$respmsg = $_POST['RESPMSG'];
			$amount = $_POST['TXNAMOUNT'];
			$date = $_POST['TXNDATE'];


			if(!isset($_SESSION['cust_email_signin'])){
				$cust_email = $_GET['cust_email'];
				$_SESSION['cust_email_signin'] = $cust_email;
				$s = "SELECT cust_id FROM customer WHERE email = '$cust_email'";
				$r = $conn -> query($s);
				$ro = $r -> fetch_assoc();
				$cust_id = $ro['cust_id'];
			
			}else{
				$cust_email = $_SESSION['cust_email_signin'];
				$s = "SELECT cust_id FROM customer WHERE email = '$cust_email'";
				$r = $conn -> query($s);
				$ro = $r -> fetch_assoc();
				$cust_id = $ro['cust_id'];
			}

      $sql = "SELECT cust_id FROM customer WHERE email = '".$cust_email."'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $cust_id = $row['cust_id'];
			$mode_of_transaction = "Online";
			$delivery_status = "Not Delivered";

			$sql = "INSERT INTO order_bill (transaction_id, cust_id, amount, payment_status, date, Mode_of_transaction, Delivery_status) VALUES('$order_id', '$cust_id', '$amount', '$status', '$date', '$mode_of_transaction', '$delivery_status')";

			if($conn -> query($sql) == TRUE){
				$_SESSION['cust_email_signin'] = $cust_email;
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
					  <link rel="stylesheet" href="../css/bootstrap.min.css">
						<title>Order</title>
					</head>
					<body>
						<div class="container">
							<div class="mt-5">
								<h1 class="text-center text-success">Thank You</h1>
								<h2 class="text-center text-success">Order Placed Successfully...</h2>
								<p class="text-center text-success">Redirecting...!</p>
							</div>
						</div>
					</body>
					</html>
				<?php
				session_destroy();
				echo "<script> setTimeout(() => {
					window.location.href = '../index.php';
				}, 2000);
				</script>";				
			}
			else{
				echo "Something went wrong";
			}



		}

	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		// foreach($_POST as $paramName => $paramValue) {
		// 		echo "<br/>" . $paramName . " = " . $paramValue;
		// }
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>