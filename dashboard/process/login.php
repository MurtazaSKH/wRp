<?php
	session_start();
	$_SESSION['ID'] = 0;
	
	$row = NULL;
	$ID = 0;
	$password = NULL;
	
	include("../requiredfiles/mysqlConnect.php");

	$EMAIL = $_POST['email'];

	$PASS 	= $_POST['password'];

	$escapedPW 	= mysql_real_escape_string($_POST['password']);
	
	//get the EID and password
	$query = "SELECT id, password FROM client WHERE email = '$EMAIL'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
	$ID = $row['id'];
	
	$password = $row['password'];
	
	$query = "select salt from client where email = '$EMAIL'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
	$salt = $row['salt'];
	
	$saltedPW =  $escapedPW . $salt;
	$hashedPW = hash('sha256', $saltedPW);

	//check if account has been activated
	$acctStatus= NULL;
	if($ID != NULL || $ID != "")
	{
		$query = "SELECT activated FROM client WHERE id = '$ID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_array($result);
		$acctStatus = $row['activated'];
	}//end of if

	if ($ID == NULL || $ID == "")//account existance check
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../index.php?flag=2";'
	   . '</script>';
	}
	elseif ($PASS== "" || $hashedPW != $password )//password check
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../index.php?flag=1";'
	   . '</script>';
	   
	}//end of else
	elseif ($acctStatus == '0')//account active check
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../index.php?flag=3";'
	   . '</script>';
	}//end of elseif
	else//get required info put it in session and redirect to account home
	{
		//get employee name
		$query = "SELECT name, company, img_loc FROM client WHERE id = '$ID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_array($result);
		$userName = $row['name'];
		$_SESSION['userName'] = $userName;
		$company = $row['company'];
		$_SESSION['company'] = $company;
		
		//get the avatar image
		$avatar = $row['img_loc'];
		if($avatar == "" || $avatar == NULL)
		{
			$_SESSION['AvatarPath'] = "images/test_avatar.png";
		}//end of if
		else
		{
			$_SESSION['AvatarPath'] = $avatar;
		}//end of else
		

		$_SESSION['ID'] = $ID;	//set the session ID
							
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../dashboard.php?flag=4";'
	   . '</script>';
	}//end of else
	
	mysql_close($db);
		?>
