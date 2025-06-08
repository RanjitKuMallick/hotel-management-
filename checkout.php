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
					<div class="signup-page-main">
						 <div class="signup-main">  	
							<div class="signup-head">
								<h1>Final Check Out</h1>
							</div>
							<div class="signup-block">
								
								<form method="post" action="./paytm/pgRedirect.php">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align: right"><label>Order ID:</label></td>
												<td>
													<input type="text"   id="ORDER_ID" name="ORDER_ID" value="<?php echo  "FDZ" . round(microtime(true) * 1000)?>" readonly>
													<input type="hidden" id="CUST_ID"  name="CUST_ID" value="<?php echo $_SESSION['email'] ?>"></td>
													<input type="hidden" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" value="Retail"></td>
													<input type="hidden" id="CHANNEL_ID" name="CHANNEL_ID" value="WEB">
												</td>
											</tr>
											<tr>
												<td style="text-align: right"><label>Amount:</label></td>
												<td>
													<input type="hidden" name="TXN_AMOUNT" value="<?php echo $_POST['amount']; ?>">
													<input type="text" value="<?php echo number_format($_POST['amount'],2); ?>" readonly style="text-align: right">
												</td>
											</tr>
											<tr>
												<td></td>
												<td><input value="Proceed to Payment" type="submit"></td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>
					<!--inner block end here-->
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
		</div>
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
