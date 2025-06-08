<?php 
	include'./include/db.php';
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}
	$sql = "SELECT f.id as fid,h.name as hname,f.category,f.subcategory,f.name as fname,f.description,f.price,f.discount,f.photo as fphoto 
	FROM HotelDetails h,FoodDetails f where h.id = f.hotel_id and 
	h.flag=TRUE and f.flag=TRUE";
	
	if(isset($_GET["resturants"]) && $_GET["resturants"]!="")
		$sql = $sql . " and h.id in ($_GET[resturants])";

	
	if(isset($_GET["categories"]) && $_GET["categories"]!="") 
		$sql = $sql . " and f.category in ($_GET[categories])";
	
	if(isset($_GET["subcategories"]) && $_GET["subcategories"]!="") 
		$sql = $sql . " and f.subcategory in ($_GET[subcategories])";

	$sql = $sql . " order by f.rank desc";

	//echo $sql;return;
	$result = $conn->query($sql);
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
					    		if ($result->num_rows == 0)
					    			echo '<div class="text-center"><img src="./images/no_food.jpg" width="50%"></div>';
					    		else
								while($product = $result->fetch_assoc()) {
									$r++;
					    	?>
					    	<div class="col-md-4 product-grid">
					    		<div class="product-items">
						    		    <div class="project-eff" style="background: url(./images/logo_small.png) center no-repeat;">
											<img class="img-responsive" style="height:200px;width:100%;" src="<?php echo $product['fphoto']?>" alt="<?php echo $product["fname"]?>">
										</div>
						    		<div class="produ-cost">
						    			<h4><?php echo $product["fname"]?></h4>
						    			<?php 
						    				$mrp = $product['price'];
						    				if($product['discount']>0){
						    					$discount= $mrp  * $product['discount'] / 100;
						    					$price = $mrp - $discount;
						    					echo "<h5 style='margin-bottom: 10px;'><strike>Rs. " . number_format($mrp, 2, '.', '') . "</strike> Rs. " . number_format($price, 2, '.', '') . "</strike></h5>";			    		
						    				}
						    				else{
						    					echo "<h5 style='margin-bottom: 10px;'>Rs. " . number_format($mrp, 2, '.', '') . "</h5>";	    		
						    				}
						    			?>
						    			<form method="get" action="cart.php">
											<input type="hidden" name="id" value="<?php echo $product['fid'] ?>" />
					    					<input type="hidden" name="action" value="add">
						    				<p class="text-center">
						    					<input type="number" name="quantity" class="btn w-25" min="1" max="10" value="1" size="1"/>
						    					<button type="submit" class="btn btn-danger"><i class="fa fa-cart-plus"></i> Add to Cart</button>
						    				</p>
						    			</form>  
						    		</div>
					    		</div>
					    	</div>

					    	<?php
					    		if($r==12)
					    			break;
					    		}
					    	?>
					    	<!--
					    	<div class="col-md-3 product-grid">
					    		<div class="product-items">
						    		    <div class="project-eff">
											<div id="nivo-lightbox-demo"> 
												<p>
													<a href="images/pro1.jpg" data-lightbox-gallery="gallery1" id="nivo-lightbox-demo">
														<span class="rollover1"> </span> 
													</a>
												</p>
											</div>     
											<img class="img-responsive" src="images/pro1.jpg" alt="">
										</div>
						    		<div class="produ-cost">
						    			<h4>Temporibus autem</h4>
						    			<h5>256 $</h5>
						    		</div>
					    		</div>
					    	</div>
					    	-->
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


                      
						
