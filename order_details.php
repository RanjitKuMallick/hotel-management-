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
					<div class="inner-block" style="padding-top: 20px;min-height: 400px;">
					    <div class="product-block">					    	
					    	<?php
								//$sql = "select * from orderdetails o,fooddetails f where orderid='$_GET[oid]' and o.itemid=f.id";
					        	$sql = "select * from orderdetails where orderid='$_GET[oid]'";
								$result = $conn->query($sql);
								if($result){
									echo "<table class='table'><tr>
										<td><b>Item Name</b></td>
										<td align='right'><b>Qty</b></td>
										<td align='right'><b>Price</b></td>
										<td align='right'><b>Discount</b></td>
										<td align='right'><b>Total</b></td>
										</tr>";
									$grandTotal=0;
									while($row = $result->fetch_assoc()) {
										$total = ($row['mrp']*$row['quantity'])-$row['discount'];
										$grandTotal=$grandTotal+$total;
										echo "<tr>
												<td>$row[itemName]</td>
												<td align='right'>$row[quantity]</td>
												<td align='right'>" . number_format($row['mrp'],2) . "</td>
												<td align='right'>" . number_format($row['discount'],2) . "</td>
												<td align='right'>" . number_format($total,2) . "</td>
											</tr>";
									}
									echo "<tr>
											<td><H3><A href='./order_history.php'>Back</A></H3></td>
											<td></td>
											<td></td>
											<td align='right'><H3>Grand Total</H3></td>
											<td align='right'><H3>" .number_format($grandTotal,2) . "</H3></td>
										</tr>";
									echo "</table>";
								}
								else{
									echo '<H3 class="text-danger">Invalid Order ID/c</H3>';
								}
							?>	
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


                      
						
