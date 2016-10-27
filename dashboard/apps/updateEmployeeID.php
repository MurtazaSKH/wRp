<?php
	include("sessionHeader.php");
	
	$newEmployeeID = $_POST['newEmployeeID'];
	
	if($newEmployeeID == "")
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=3";'
	   . '</script>';
	}//end of if
	else
	{
		include("mysqlConnect.php");
		
		$query = "UPDATE employeeinfo SET EmployeeID = '$newEmployeeID' WHERE EID = '$userID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		mysql_close($db);
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "settings.php?flag=7";'
	   . '</script>';
	}//end of else
?>