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
					<?php include 'header_main.php'; ?>	
					<!--heder end here-->
					<!--inner block start here-->
					<div class="signup-page-main">
						 <div class="signup-main">  	
							<div class="signup-head">
								<h1>Order Status</h1>
							</div>
							<div class="signup-block text-center">	
								<?php
									if(isset($_GET['oid']))
										echo "
											<H2 class='text-primary'>Thank You for placing Order</H2>	
											<H4>Your Order ID is <span  class='text-success'>$_GET[oid]</span></H4>";
									else
										echo "<H2 class='text-danger'>Transaction status is failure</H2>";
								?>							
								
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
