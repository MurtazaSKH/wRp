<?php
	$deptID = $_GET['deptid'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT DsgID, DsgName FROM designations WHERE DeptID = '$deptID'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$num_results = mysql_num_rows($result);	
	$row = NULL;
	
	$desgList = NULL;
	for($i=0; $i< $num_results; $i++)
	{
		$row = mysql_fetch_array($result);
		$desgList = $desgList . $row['DsgID'] . "-" . $row['DsgName'];
		$desgList = $desgList . "&";
	}//end of for

	echo $desgList;
	
	mysql_close($db);
?>