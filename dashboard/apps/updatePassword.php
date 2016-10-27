<?php
	include("sessionHeader.php");

	$currentPassword = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];
	$confirmNewPassword = $_POST['confirmNewPassword'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT Password FROM employeeinfo WHERE EID='$userID'";	//get old/ current password
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$num_results = mysql_num_rows($result);	
	$row = mysql_fetch_array($result);
	
	if($currentPassword == "" || $newPassword == "" || $confirmNewPassword == "")//check if fields empty
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=3";'
	   . '</script>';
	}//end of if
	elseif ($currentPassword != $row['Password'])
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=4";'
	   . '</script>';
	}
	elseif ($newPassword != $confirmNewPassword)
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=5";'
	   . '</script>';
	}
	else
	{
		$query = "UPDATE employeeinfo SET Password = '$newPassword' WHERE EID = '$userID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		mysql_close($db);
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=6";'
	   . '</script>';
		
	}

?>