<?php 
	include'./include/db.php';
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include './include/head.php'; ?>
	</head>
	<body>	
		<div class="page-container">	
   			<div class="left-content">
	   			<div class="mother-grid-inner">
            		<!--header start here-->
					<?php include './include/header_main.php'; ?>	
					<!--heder end here-->
					<!--inner block start here-->
					<div class="inner-block">
					    <div class="product-block">					    	
					    	<?php
					    		$r=0;

					    		if (!isset($_SESSION["cart_item"]))
					    			echo '<div class="text-center"><img src="./images/no_food.jpg" width="50%"></div>';
					    		else{
					    			echo '<table class="table">
					    				<tr>
					    					<th style="text-align:left;">SL No</th>
					    					<th style="text-align:center;">Photo</th>
					    					<th style="text-align:left;">Name of Item</th>
					    					<th style="text-align:right;">MRP</th>
					    					<th style="text-align:right;">Discount</th>
					    					<th style="text-align:right;">Price</th>
					    					<th style="text-align:right;">Qty</th>
					    					<th style="text-align:right;">Total Price</th>
					    					<th></th>
					    					</tr>';
					    		$total_price=0.0;
								foreach($_SESSION["cart_item"] as $k => $v){
									$r++;
									$qty = $v['quantity'];
									$mrp = $v['price'];
									$discount = $mrp*$v['discount']/100;
									$price = $mrp - $discount;
									$total = $price * $qty;
									$total_price += $total;
									echo "<tr>
					    					<td>$r</td>
					    					<td style='text-align:center;'><img src='$v[photo]' width='70'></td>
					    					<td style='text-align:left;'>$v[name]</td>
					    					<td style='text-align:right;'>" . number_format($mrp,2) . "</td>
					    					<td style='text-align:right;'>" . number_format($discount,2) . "</td>
					    					<td style='text-align:right;'>" . number_format($price,2) . "</td>
					    					<td style='text-align:right;'>$qty</td>
					    					<td style='text-align:right;'>" . number_format($total,2) . "</td>
					    					<td style='text-align:center;'>
					    					<a href='cart.php?action=remove&id=$v[id]' class='btnRemoveAction'>
					    					<img src='./images/icon-delete.png' alt='Remove Item' />
					    					</a></td>
										</tr>";
					    	?>

					    	<?php
					    		}
					    		echo "<tr><th  style='text-align:right;' colspan='8'> Total Price : " . number_format($total_price,2) . "</th><td></td></tr></table>";
					    		}
					    	?>
					    	<form action="./checkout.php" method="post" style="text-align: right;">
					    		<input type="hidden" name="amount" value="<?php echo $total_price; ?>">
					    		<input type="image" name="submit" src="./images/checkout.png" height="50">

					    	</form>
					      <div class="clearfix"> </div>
					    </div>
					</div>
					<!--inner block end here-->
					<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
					<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function(){
						    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });
						});
					</script>
					<!--copy rights start here-->
					<?PHP include './include/copy_right.php'; ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--slider menu-->
			<?php 
				if(strtolower($_SESSION['email']) == 'admin@gmail.com')
					include './include/side_bar_admin.php';
				else
					include './include/side_bar_user.php';
			?>
			<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
