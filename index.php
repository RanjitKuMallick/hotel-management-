<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location:./login.php');
	}	
	else if($_SESSION['user']=="Admin"){
		header('Location:./home.php');
	}
	else{
		header('Location:./product.php');
	}
?>