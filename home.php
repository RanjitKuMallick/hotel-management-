<?php
	include './include/db.php';	
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include './include/head.php'; ?>
		<!-- geo chart -->
	    <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
	    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
	    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->

		<!--skycons-icons-->
		<script src="js/skycons.js"></script>
		<!--//skycons-icons-->
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
					<!--market updates updates-->
		 				<div class="market-updates">
							<div class="col-md-4 market-update-gd">
								<div class="market-update-block clr-block-1">
									<div class="col-md-8 market-update-left">
										<h3>
										<?php
											$sql = "SELECT count(*) as no FROM UserDetails";
											$result = $conn->query($sql);
											 $row = $result->fetch_assoc();
											 echo $row['no'];
										?>
										</h3>
										<h4>Registered User</h4>
									</div>
									<div class="col-md-4 market-update-right">
										<i class="fa fa-user"> </i>
									</div>
					  				<div class="clearfix"> </div>
								</div>
							</div>
							<div class="col-md-4 market-update-gd">
								<div class="market-update-block clr-block-2">
					 				<div class="col-md-8 market-update-left">
										<h3>135</h3>
										<h4>Visitors</h4>
					  				</div>
									<div class="col-md-4 market-update-right">
										<i class="fa fa-users"> </i>
									</div>
					  				<div class="clearfix"> </div>
								</div>
							</div>
							<div class="col-md-4 market-update-gd">
								<div class="market-update-block clr-block-3">
									<div class="col-md-8 market-update-left">
										<h3>23</h3>
										<h4>Total Order</h4>
									</div>
									<div class="col-md-4 market-update-right">
										<i class="fa fa-truck"> </i>
									</div>
								  <div class="clearfix"> </div>
								</div>
							</div>
						   	<div class="clearfix"> </div>
						</div>
						<!--market updates end here-->
						<!--main page chart layer2-->
						<div class="chart-layer-2 text-center">
							<img src="./images/logo.png" style="width: 50%;">							
						  	<div class="clearfix"> </div>
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