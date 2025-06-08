<?php
	include './include/db.php';	
	$name="";
	$email="";
	$phone="";
	$password="";	
	if(isset($_POST['signup'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=$_POST['password'];

		$sql = "INSERT INTO UserDetails (name, email,phone,password) 
	        VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', '" . $password . "')";
		if ($conn->query($sql) === TRUE) {
			$name="";
			$email="";
			$phone="";
			$password="";
			echo '<script>alert("Your Acount created Successfully. You can Login Now");</script>';	
			header('Location:./login.php');    	
	    }
	    else{
	        echo '<script>alert("Some thing went wrong, Please try again latter.");</script>';	    	
	    }
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include './include/head.php'; ?>
	</head>
	<body>	
		<div class="signup-page-main">
		     <div class="signup-main">  	
		    	<div class="signup-head">
					<h1>Sign Up</h1>
				</div>
				<div class="signup-block">
					<form method="post">
						<input type="text" name="name" placeholder="Name" required="" value="<?php echo $name; ?>">
						<input type="text" name="email" placeholder="Email" required="" class="form_element" value="<?php echo $email; ?>">
						<input type="text" name="phone" placeholder="Phone" required="" value="<?php echo $phone; ?>">
						<input type="password" name="password" class="lock" placeholder="Password" required="" value="">
						
						<input type="submit" name="signup" value="Sign up">										
					</form>
					<div class="sign-down">
						<h4>Already have an account? <a href="./login.php"> Login here.</a></h4>
					</div>
				</div>
		    </div>
		</div>
		<!--inner block end here-->
		<!--copy rights start here-->
		<?php include './include/copy_right.php'; ?>
		<!--COPY rights end here-->

		<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
		<script src="js/bootstrap.js"> </script>
		<!-- mother grid end here-->
	</body>
</html>


                      
						
