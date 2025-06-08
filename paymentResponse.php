<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./paytm/lib/config_paytm.php");
require_once("./paytm/lib/encdec_paytm.php");
require_once("./db.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		
		foreach($_SESSION["cart_item"] as $k => $v){
			$qty = $v['quantity'];
			$mrp = number_format($v['price'],2);
			$discount=number_format($mrp*$v['discount']/100,2);
			$price=number_format($mrp - $discount,2);
			$total=number_format($price * $qty,2);
			$sql = "INSERT INTO OrderDetails(orderid,txndate,txnid,banktxnid,txnamount,itemid,quantity,price,email) values('$_POST[ORDERID]','$_POST[TXNDATE]','$_POST[TXNID]','$_POST[BANKTXNID]',$_POST[TXNAMOUNT],
						$k,$qty,$price,'$_SESSION[email]');";
			//echo '<br>' . $sql;
			$conn->query($sql);
		}
		unset($_SESSION["cart_item"]);
		header("location: ./order_status.php?oid=" . $_POST[ORDERID]);
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";

		header('location:./order_status.php');
	}
/*
	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
*/
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>