<?php
	include './include/db.php';	
	$name="";
	$email="";
	$phone="";	
	if(isset($_POST['update'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];

		$sql = "UPDATE UserDetails set name='$name', phone='$phone' where email='$email'";

		if ($conn->query($sql) === TRUE) {
			$msg = "Your Acount info Updated Successfully";
	    }
	    else{
	        $errmsg = "Some thing went wrong, Please try again latter.";	    	
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
								<h1>My Profile</h1>
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

										$sql = "SELECT * from UserDetails where email='$_SESSION[email]'";
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
						
								?>
								<form method="post">
									<input type="text" name="email" placeholder="Email" required="" class="form_element" value="<?php echo $row['email']; ?>" readonly>
									<input type="text" name="name" placeholder="Name" required="" value="<?php echo $row['name']; ?>">
									<input type="text" name="phone" placeholder="Phone" required="" value="<?php echo $row['phone']; ?>">
									
									<input type="submit" name="update" value="Update">										
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
