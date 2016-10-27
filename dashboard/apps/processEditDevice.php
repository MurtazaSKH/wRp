<?php
	include("header.php");
	
	$deviceName = $_POST['deviceName'];
	$osType = $_POST['osType'];
	$osVersion = $_POST['osVersion'];
	$dids = $_POST['dids'];
	
	if ($deviceName == "No Device" || $osType == "" || $osVersion == "")	//check for empty fields
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "alterRecords.php?flag=3";'
	   . '</script>';
	}//end of if
	
	include("mysqlConnect.php");
	
	$query = "UPDATE devicelist SET OSType = '$osType', OSVersion = '$osVersion', DIDs = '$dids' WHERE DeviceName = '$deviceName'";
	mysql_query($query) or die('Query failed: ' . mysql_error());
	
	//success case
	echo '<script type="text/javascript">'
   		. 'window.location.href = "drec_home.php?flag=5";'
   		. '</script>';
		
	mysql_close($db);
?>