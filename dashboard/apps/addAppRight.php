<?php
	include("sessionHeader.php");
	
	$updatedDeptID = $_POST['departmentName'];
	if($updatedDeptID== "0")//check if department name is selected
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_appRights.php?flag=2";'
	   . '</script>';
	}//end of if
	
	$updatedDsgID = $_POST['dsgList'];
	if($updatedDsgID == "0")//check if designation is selected
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_appRights.php?flag=2";'
	   . '</script>';
	}//end of if
	
	$updatedappName = $_POST['appName'];
	if($updatedappName == "None")
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_appRights.php?flag=3";'
	   . '</script>';
	}
	
	$updatedrightName = $_POST['rightName'];
	if($updatedrightName == "None")
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_appRights.php?flag=4";'
	   . '</script>';
	}
	else
	{
		include("mysqlConnect.php");
		
		$query = "SELECT Permission FROM operationrights 
		WHERE DsgID = '$updatedDsgID' AND RightName = '$updatedrightName' AND AppName = '$updatedappName'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$num_results = mysql_num_rows($result);
		
		if($num_results ==0)//if the entry is unique
		{
			$query = "INSERT INTO operationrights(DsgID, RightName, AppName, Permission) 
			VALUES ('$updatedDsgID', '$updatedrightName', '$updatedappName', '1');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			mysql_close($db);
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "admin_appRights.php?flag=1";'
		   . '</script>';
		}//end of if
		else//if the entry is a duplicate
		{
			echo '<script type="text/javascript">'
		   . 'window.location.href = "admin_appRights.php?flag=6";'
		   . '</script>';
		}
		
	   
	}//end of else
?>