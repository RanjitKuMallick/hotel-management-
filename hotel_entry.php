<?php
	include './include/db.php';	
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}
	$name="";
	$email="";
	$phone="";
	$address="";	
	if(isset($_POST['save'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];		// Info! Some thing went wrong, Please try again latter. uploads/hotels/1627409922.png


		$target_dir = "uploads/hotels/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$target_file_path = $target_dir . time() . "." . $imageFileType;
		$upload_status = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_path);
	    if ($upload_status) {
	        $sql = "INSERT INTO HotelDetails (name, email,phone,address,photo) 
	        VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', '" . $address . "', '" . $target_file_path . "')";
			if ($conn->query($sql) === TRUE) {
				$name="";
				$email="";
				$phone="";
				$address="";
				$msg = "Hotel Added Successfully.  $target_file_path ";	
			}
			else{
				$errmsg = "Some thing went wrong, Please try again latter. $target_file_path ";
			}
			//echo $sql;return;
	    } 
	    else {
	        $errmsg = "Some thing went wrong, Please try again latter. $target_file_path ";
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
								<h1>New Hotel Entry</h1>
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
									<input type="text"  name="name"  value="<?php echo $name; ?>" placeholder="Resturant Name" required="">
									<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required="" class="form-element">
									<input type="text"  name="phone" value="<?php echo $phone; ?>" placeholder="Phone No" required="">
									<textarea name="address" placeholder="Hotel Address..." required="" class="form-element"><?php echo $address; ?></textarea>
									<input type="file" name="image" id="image" required="" style="float:left;" onChange="PreviewImage();">
									<img src="./images/img1.jpg" id="imageView" width="150" height="80" style="float:right;margin-bottom: 20px;">

									<input type="submit" name="save" value="Save Hotel" >
								</form>
							</div>
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
