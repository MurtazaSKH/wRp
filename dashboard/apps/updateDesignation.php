<?php
	include("sessionHeader.php");

	$updatedEID = $_POST['employeeName'];
	if($updatedEID == "0")//check if an employee is selected
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_employeeOperations.php?flag=4";'
	   . '</script>';
	}//end of if

	$updatedDeptID = $_POST['departmentName'];
	if($updatedDeptID== "0")//check if department name is selected
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_employeeOperations.php?flag=2";'
	   . '</script>';
	}//end of if
	
	$updatedDsgID = $_POST['dsgList'];
	if($updatedDsgID == "0")//check if designation is selected
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_employeeOperations.php?flag=2";'
	   . '</script>';
	}//end of if
	else
	{
		include("mysqlConnect.php");
		
		$query = "UPDATE employeedesignation SET DsgID = '$updatedDsgID' WHERE EID = '$updatedEID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		if($userID == $updatedEID)
		{
			$query = "SELECT DsgName FROM designations WHERE DsgID = '$updatedDsgID'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row = mysql_fetch_array($result);
	
			//update designation name in session variable
			$dsgName = $row['DsgName'];
			$_SESSION['dsgName'] = $row['DsgName'];
			
			//update designation ID in session variable
			$dsgID = $updatedDsgID;
			$_SESSION['dsgID'] = $updatedDsgID;
		}//end of if
		
		mysql_close($db);
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_employeeOperations.php?flag=1";'
	   . '</script>';
	}//end of else
?>