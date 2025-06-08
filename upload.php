<?php
	if(isset($_POST['upload'])){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$target_file_path = $target_dir . time() . "." . $imageFileType;
		$upload_status = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_path);
	    if ($upload_status) {
	        $msg = "Image Upload Successfully.";
	    } 
	    else {
	        $msg = "Some thing went wrong, Please try again latter.";
	    }
	}
?>

<!DOCTYPE HTML>
<html>
	<body>	
		<?php 
			if(isset($msg))
				echo '<strong>Info!</strong> ' . $msg ;
		?>
		<script>
			$(".div1").delay(3200).fadeOut(300);
		</script>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="image" id="image" required="" style="float:left;" onChange="PreviewImage();">
			
			<input type="submit" name="upload" value="Upload Image" >
		</form>
	</body>
</html>					
