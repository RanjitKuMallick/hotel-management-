<?php
	include './include/db.php';	
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}
	if(isset($_POST['update'])){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$sql = "update HotelDetails set name='$name', email='$email', phone='$phone', address='$address' where id=$id";
		
		if ($conn->query($sql) === TRUE) {	
			$msg="Hotel Details Updated Successfully";
		}
		else{
			$errmsg="Some thing went wrong, Please try again latter.";
		}
	}
	else if(!isset($_GET['id'])){
		header('location:./');
	}
	else{										
		$sql = "SELECT * FROM HotelDetails where id = $_GET[id]";
		$result = $conn->query($sql);
		if($q = $result->fetch_assoc()){		
			$id=$q['id'];									
			$name=$q['name'];
			$email=$q['email'];
			$phone=$q['phone'];
			$address=$q['address'];
		}
		else{	
			$errmsg="Invalid Hotel ID.";
			$id="";
			$name="";
			$email="";
			$phone="";
			$address="";
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
									<input type="hidden" value="<?php echo $id; ?>" name="id">
									<input type="text"  name="name"  value="<?php echo $name; ?>" placeholder="Resturant Name" required="">
									<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required="" class="form-element">
									<input type="text"  name="phone" value="<?php echo $phone; ?>" placeholder="Phone No" required="">
									<textarea name="address" placeholder="Hotel Address..." required="" class="form-element"><?php echo $address; ?></textarea>
									<input type="submit" name="update" value="Update Hotel Details" >
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
