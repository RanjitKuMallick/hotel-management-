<?php
	include './include/db.php';
	if(isset($_SESSION['user'])){
		header('Location:./');
	}	
?>
<?php
	$email="";
	$password="";	
	if(isset($_POST['signin'])){
		$email=$_POST['email'];
		$password=$_POST['password'];
        $sql = "Select * from UserDetails where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if($row = $result->fetch_assoc()){        	
        	$_SESSION['user']=$row['name'];
        	$_SESSION['email']=$email;          	
        	$_SESSION['photo']=$row['photo'];    	
        	header('Location:./');
        }
        else{
        	echo '<script>alert("Invalid ID or Password, Please try again");</script>';
        }
    } 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include './include/head.php'; ?>
	</head>
	<body>	
		<div class="login-page">
		    <div class="login-main">  	
	    	 	<div class="login-head">
					<h1>Login</h1>
				</div>
				<div class="login-block">
					<form method="post">
						<input type="text" name="email" placeholder="Email" required="" value="<?php echo $email; ?>">
						<input type="password" name="password" class="lock" placeholder="Password" value="<?php echo $password; ?>">
						<div class="forgot-top-grids">
							<div class="forgot">
								<a href="./password_reset.php">Forgot password?</a>
							</div>
							<div class="clearfix"> </div>
						</div>
						<input type="submit" name="signin" value="Login">	
						<h3>Not a member?<a href="./signup.php"> Sign up now</a></h3>
					</form>
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


                      
						
