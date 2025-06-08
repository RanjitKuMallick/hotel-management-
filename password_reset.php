<?php
	include './include/db.php';	
	$name="";
	$email="";
	$phone="";	
	if(isset($_POST['recover'])){
		$name=strtolower($_POST['name']);
		$email=strtolower($_POST['email']);
		$phone=$_POST['phone'];

		$sql = "SELECT password from UserDetails where lower(name)='$name' and lower(email)='$email' and phone='$phone'"; 
		
		
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			//mail($email, "Your Foodeez A/c Password", 'Your Password is ' . $row['password']);
			$msg = 'Your password has been sent to your registered email id';	
			$name="";
			$email="";
			$phone="";
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
		<div class="signup-page-main">
		     <div class="signup-main">  	
		    	<div class="signup-head">
					<h1>Forget Password</h1>
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
					<form method="post">
						<input type="text" name="name" placeholder="Name" required="" value="<?php echo $name; ?>">
						<input type="text" name="email" placeholder="Email" required="" class="form_element" value="<?php echo $email; ?>">
						<input type="text" name="phone" placeholder="Phone" required="" value="<?php echo $phone; ?>">
						<input type="submit" name="recover" value="Recover">										
					</form>
					<div class="sign-down">
						<h4>Already have Password? <a href="./login.php"> Login here.</a></h4>
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


                      
						
