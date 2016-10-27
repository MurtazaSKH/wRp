<?php
  //include('checkSession.php');
  
	$number = $_POST['number'];
	$name = $_POST['name'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$oldpassword = $_POST['oldpassword'];
	$address = $_POST['address'];
	
	$textToStore = htmlentities($address, ENT_QUOTES, 'UTF-8');

	include("../requiredfiles/mysqlConnect.php");
	
	$query = "SELECT id, password, salt, img_loc FROM client WHERE email = '$email'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
	$ID = $row['id'];
	$salt = $row['salt'];
	$PASS = $row['password'];
	
	if (!$_FILES['avatar'])
	$avatar = $row['img_loc'];
	else {
		
		$target_dir = "../assets/images/avatars/";
		$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
		
		echo $target_file;
		
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["avatar"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["avatar"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$avatar = "/assets/images/avatars/".basename($_FILES["avatar"]["name"]);
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
	}
	
	if ($password || $password2)
	{
		if($password != $password2)//check password recheck
		{		
			echo '<script type="text/javascript">'
				   . 'window.location.href = "../editprofile.php?flag=1";'
				   . '</script>';
		}//end of if
		
		if(!$oldpassword)//check password recheck
		{		
			echo '<script type="text/javascript">'
				   . 'window.location.href = "../editprofile.php?flag=2";'
				   . '</script>';
		}//end of if
		else {
			
			$escapedPW = mysql_real_escape_string($oldpassword);
			
			$saltedPW =  $escapedPW . $salt;
			$hashedPW = hash('sha256', $saltedPW);
			
			if ( $hashedPW != $PASS ) 
			{	
				echo '<script type="text/javascript">'
				   . 'window.location.href = "../editprofile.php?flag=3";'
				   . '</script>';
			}
			else {
				
				# generate a random salt to use for this account
				$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
				
				$escapedPW = mysql_real_escape_string($password);
		
				$saltedPW =  $escapedPW . $salt;
				$hashedPW = hash('sha256', $saltedPW);
				
				$query = "UPDATE client SET password = '$password', salt = '$salt' where id = '$ID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			}
		}
	}
		
	//insert the employee data in DB
	$query = "UPDATE `client` SET `name` = '$name', `company` = '$company', `contactno` = '$number', `address` = '$textToStore', `img_loc`  = '$avatar' where id = '$ID'";
	mysql_query($query) or die('Query failed: ' . mysql_error());

/*	echo '<script type="text/javascript">'
		   . 'window.location.href = "../editprofile.php?flag=4";'
		   . '</script>';
*/	
	mysql_close($db);
?>