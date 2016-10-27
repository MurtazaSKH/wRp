<?php
	$deptID = $_GET['deptid'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT DsgID, DsgName FROM designations WHERE DeptID = '$deptID'";
	$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
	$num_results = mysqli_num_rows($result);	
	$row = NULL;
	
	$desgList = NULL;
	for($i=0; $i< $num_results; $i++)
	{
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$desgList = $desgList . $row['DsgID'] . "-" . $row['DsgName'];
		$desgList = $desgList . "&";
	}//end of for

	echo $desgList;
	
	mysqli_close($db);
?>