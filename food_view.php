<?php 
	include'./include/db.php';
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}
	
	if(isset($_POST['status'])){
		$id=$_POST['id'];
		$flag=$_POST['flag'];
		$sql = "update FoodDetails set flag='" . ($flag xor 1) . "' where id=$id";
		//echo $flag; echo $sql;return;
		if ($conn->query($sql) === TRUE) {
			$msg = "Food Updated Successfully.";	    	
	    }
	    else{
	        $errmsg = "Some thing went wrong, Please try again latter.";
	    }
	}
	else if(isset($_POST['edit'])){
		header("location:./food_edit.php?id=" . $_POST['id']);
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
    					<div class="chart-main-block">
       						<div class="chart-first-line">
    							<div class="col-md-12 chart-blo-1">
    	   							<table class="table">
    	   								<tr>
    	   									<th>SL NO</th>
    	   									<th>HOTEL NAME</th>
    	   									<th>CATEGORY</th>
    	   									<th>SUB CATEGORY</th>
    	   									<th>FOOD ITEM NAME</th>
    	   									<th>DESCRIPTION</th>
    	   									<th>PRICE</th>
    	   									<th>DISCOUNT</th>
    	   									<th>PHOTO</th>
    	   									<th>ACTION</th>
    	   								</tr>
    	   								<?php
											$sql = "SELECT 
													f.id as fid,
													h.name as hname,
													f.category,
													f.subcategory,
													f.name as fname,
													f.description,
													f.price,
													f.discount,
													f.photo as fphoto,
													f.flag as flag
													FROM HotelDetails h,FoodDetails f where h.id = f.hotel_id";
											$result = $conn->query($sql);
    	   									$r=0;
											while($row = $result->fetch_assoc()) {
												$status="";
										 		if($row['flag'])
											 		$status="<i class='fa fa-eye'  style='color:green;'></i>";
											 	else
											 		$status="<i class='fa fa-eye-slash' style='color:red;'></i>";
											 	$r++;
											 	echo "<tr>
		    	   									<td>$r</td>
		    	   									<td>$row[hname]</td>
		    	   									<td>$row[category]</td>
		    	   									<td>$row[subcategory]</td>
		    	   									<td>$row[fname]</td>
		    	   									<td>$row[description]</td>
		    	   									<td>$row[price]</td>
		    	   									<td>$row[discount]</td>
		    	   									<td><img src='$row[fphoto]' style='height:50px; width:80px;'></td>
		    	   									<td>
														<form method='post'>
		    	   											<input type='hidden' name='id' value='$row[fid]'>
		    	   											<input type='hidden' name='flag' value='$row[flag]'>
			    	   										<button type='submit' name='status'>$status</button>
			    	   										<button type='submit' name='edit'><i class='fas fa-edit'></i></button>
			    	   									</form>
		    	   									</td>
		    	   								</tr>";
											 }
										?>
    	   								
    	   							</table>
    	 						</div>
    	  						<div class="clearfix"> </div>
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
