
<?php 
	include'./include/db.php';
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}	

	$hotel="";
	$category="";
	$subCategory="";
	$name="";
	$description="";
	$price="";
	$discount="";	
	if(isset($_POST['save'])){
		$hotel=$_POST['hotel'];
		$category=$_POST['category'];
		$subCategory=$_POST['subCategory'];
		$name=$_POST['name'];
		$description=$_POST['description'];
		$price=$_POST['price'];
		$discount=$_POST['discount'];

		$target_dir = "uploads/foods/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$target_file_path = $target_dir . time() . "." . $imageFileType;
		
	    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_path)) {
	        $sql = "INSERT INTO FoodDetails (hotel_id, category, subcategory, name, description, price, discount, photo) 
	        VALUES ($hotel,$category,$subCategory,'$name','$description',$price,$discount,'$target_file_path')";
	        //echo $sql;return;
			if ($conn->query($sql) === TRUE) {	
				$hotel="";
				$category="";
				$subCategory="";
				$name="";
				$description="";
				$price="";
				$discount="";	
				//echo '<script>alert("Food Added Successfully.");</script>';	 
				$msg="Food Added Successfully";
			}
			else{
				//echo '<script>alert("Some thing went wrong, Please try again latter.");</script>';						 
				$errmsg="Some thing went wrong, Please try again latter.";
			}
	    } 
	    else {
	        //echo '<script>alert("Some thing went wrong, Please try again latter.");</script>'; 
				$errmsg="Some thing went wrong, Please try again latter.";
	    }
	    
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
								<h1>New Food Entry</h1>
							</div>
							<div class="signup-block">
								<?php 
									if(isset($msg))
										echo '
											<div class="div1 alert alert-success">
												<strong>Info!</strong> ' . $msg . '
											</div>
										';
									if(isset($errmsg))
										echo '
											<div class="div1 alert alert-danger">
												<strong>Info!</strong> ' . $errmsg . '
											</div>
										';
								?>
								<script>
									$(".div1").delay(3200).fadeOut(300);
								</script>
								<form method="post" enctype="multipart/form-data">									
									<select class="form-element" name="hotel">
										<option value="">Select Hotel</option>
										<?php
											$sql = "SELECT id, name FROM HotelDetails where flag=TRUE order by name";
											$hotels = $conn->query($sql);
											 while($row = $hotels->fetch_assoc()) {
											 	if($row["id"]==$hotel)
											 	echo "<option value='$row[id]' selected>$row[name]</option>";
											 else
											 	echo "<option value='$row[id]'>$row[name]</option>";
											 }
										?>
									</select>
									<select class="form-element" name="category">
										<option value="">Select Category</option>
										<?php
											$sql = "SELECT * FROM CategoryDetails";
											$result = $conn->query($sql);
											 while($row = $result->fetch_assoc()) {
											 	if($row["id"]==$category)
											 	echo "<option value='$row[id]' selected>$row[category]</option>";
											 else
											 	echo "<option value='$row[id]'>$row[category]</option>";
											 }
										?>
									</select>
									<select class="form-element" name="subCategory">
										<option value="">Select Sub Category</option>
										<?php
											$sql = "SELECT * FROM SubCategoryDetails";
											$result = $conn->query($sql);
											//echo $sql;return;
											 while($row = $result->fetch_assoc()) {
											 	if($row["id"]==$subCategory)
											 	echo "<option value='$row[id]' selected>$row[subcategory]</option>";
											 else
											 	echo "<option value='$row[id]'>$row[subcategory]</option>";
											 }
										?>
									</select>								
									<input type="text" value="<?php echo $name; ?>" name="name" placeholder="Item Name" required="">
									<textarea name="description" placeholder="Item Description..." required="" class="form-element"><?php echo $description; ?></textarea>
									<input type="text" value="<?php echo $price; ?>" name="price" placeholder="Price in Rupees" required="">
									<input type="text" value="<?php echo $discount; ?>" name="discount" placeholder="Discount in Percentage" required="">
									<input type="file" name="image" id="image" required="" style="float:left;" onChange="PreviewImage();">
									<img src="./images/img2.png" id="imageView" style="width: 150; height: 80px; float:right;margin-bottom: 20px;">

									<input type="submit" name="save" value="Save Food">														
								</form>
							<script>		
								function PreviewImage() {
									var oFReader = new FileReader();
									oFReader.readAsDataURL(document.getElementById("image").files[0]);												
									oFReader.onload = function (oFREvent) {
										document.getElementById("imageView").src = oFREvent.target.result;
									};
								}
							</script>
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
