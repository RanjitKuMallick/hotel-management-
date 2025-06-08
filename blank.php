
<!DOCTYPE HTML>
<html>
	<head>
		<?php include 'head.php'; ?>
	</head>
	<body>	
		<div class="page-container">	
   			<div class="left-content">
	   			<div class="mother-grid-inner">
            		<!--header start here-->
					<?php include 'header_main.php'; ?>	
					<!--heder end here-->
					<!--inner block start here-->
					<div class="inner-block">
    					<div class="chart-main-block">
       						<div class="chart-first-line">
    							<div class="col-md-12 chart-blo-1">
    	   							<div class="dygno">
    		     						<h2>Doughnut</h2>
									    <canvas id="doughnut" height="300" width="470" style="width: 470px; height: 300px;"></canvas>
										<script>
											var doughnutData = [
											{
												value: 30,
												color:"#337AB7"
											},
											{
												value : 50,
												color : "#929292"
											},
											{
												value : 100,
												color : "#FC8213"
											},
											{
												value : 40,
												color : "#68AE00"
											},
											];
											new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
										</script>
									</div>	
    	 						</div>
    	  						<div class="clearfix"> </div>
    						</div>
					    </div>
					</div>
					<!--inner block end here-->
					<!--copy rights start here-->
					<?PHP include 'copy_right.php'; ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--slider menu-->
 			<?php include 'side_bar.php';?>
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
