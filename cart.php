<?php
	require_once("./include/db.php");
	if(!empty($_GET["action"])) {
		switch($_GET["action"]) {
			case "add":
				if(!empty($_GET["quantity"])) {
					$result = $conn->query("SELECT * FROM FoodDetails WHERE id='" . $_GET["id"] . "'");
					$productByCode = $result->fetch_assoc();
					/*$itemArray = array($productByCode["id"]=>array('name'=>$productByCode["name"], 
																	'id'=>$productByCode["id"], 
																	'quantity'=>$_GET["quantity"], 
																	'price'=>$productByCode["price"], 
																	'discount'=>$productByCode["discount"], 
																	'photo'=>$productByCode["photo"]));*/
					$itemArray = array('name'=>$productByCode["name"], 
										'id'=>$productByCode["id"], 
										'quantity'=>$_GET["quantity"], 
										'price'=>$productByCode["price"], 
										'discount'=>$productByCode["discount"], 
										'photo'=>$productByCode["photo"]);
					
					if(!empty($_SESSION["cart_item"])) {
						if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {
							foreach($_SESSION["cart_item"] as $k => $v) {
									if($productByCode["id"] == $k) {
										if(empty($_SESSION["cart_item"][$k]["quantity"])) {
											$_SESSION["cart_item"][$k]["quantity"] = 0;
										}
										$_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
									}
							}
						} else {
							//$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);

							$_SESSION["cart_item"][$itemArray['id']] = $itemArray;
						}
					} else {
						$_SESSION["cart_item"][$itemArray['id']] = $itemArray;
					}
				}

				header("location:./product.php");
			break;
			case "remove":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($_GET["id"] == $k)
								unset($_SESSION["cart_item"][$k]);				
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}	

				header("location:./my_cart.php");
			break;
			case "empty":
				unset($_SESSION["cart_item"]);
			break;	
		}
	}
?>