<?php 
	include'./include/db.php';
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}	

	$ORDERID = $_GET['ORDERID'];
	$TXNID = $_GET['TXNID'];
	$TXNDATE = $_GET['TXNDATE'];

	foreach($_SESSION["cart_item"] as $k => $v){

		$qty = $v['quantity'];
		$mrp = $v['price'];
		$discount = $mrp*$v['discount']/100;
		$item = $v['name'];

		$sql="Insert into orderdetails values('$ORDERID', '$_SESSION[email]', '$TXNDATE', '$TXNID', '$item', $qty, $mrp, $discount)";
		echo $sql."<br>";
		if ($conn->query($sql) === TRUE) { 
			unset($_SESSION["cart_item"]);
			header('LOcation:./order_status.php?oid='.$ORDERID);

		}
		else{
			echo '<script>alert("Some thing went wrong, Please try again latter.");</script>';	
			header('LOcation:./order_status.php');
		}
		echo $msg;
	}
?>