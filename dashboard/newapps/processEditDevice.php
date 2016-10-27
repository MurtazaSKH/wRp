<?php
	include("header.php");
	
	$did = $_POST['id'];
	$deviceName = $_POST['deviceName'];
	$osType = $_POST['osType'];
	$pType = $_POST['pType'];
	$osVersion = $_POST['osVersion'];
	$dids = $_POST['dids'];
	$imei = $_POST['imei'];
	$vendor = $_POST['vendor'];
	$resolution = $_POST['resolution'];
	
	echo $deviceName.$osType.$pType.$osVersion.$dids.$imei.$vendor.$resolution.$did;
	
	if ($deviceName == "" || $osType == "" || $osVersion == "" || $dids == "" || $imei == "" || $pType == "" || $vendor == "" || $resolution == "")	//check for empty fields
	{
		echo "<script type=\"text/javascript\">"
	   . "window.location.href = \"editdevice.php?did=".$deviceName."&flag=3\";"
	   . "</script>";
	}//end of if
	
	include("mysqlConnect.php");
	
	if ($deviceName != "")	
	{
		$query = "UPDATE devicelist SET DeviceName = '$deviceName' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($osType != "")
	{
		$query = "UPDATE devicelist SET OSType = '$osType' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($osVersion != "")
	{
		$query = "UPDATE devicelist SET OSVersion = '$osVersion' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($dids != "")
	{
		$query = "UPDATE devicelist SET DIDs = '$dids' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($imei != "")
	{
		$query = "UPDATE devicelist SET EMEI = '$imei' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($pType != "")
	{
		$query = "UPDATE devicelist SET Priority = '$pType' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($vendor != "")
	{
		$query = "UPDATE devicelist SET Vendor = '$vendor' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	if ($resolution != "")
	{
		$query = "UPDATE devicelist SET Resolution = '$resolution' WHERE DeviceID = '$did'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	
	mysql_close($db);
	
	//success case
	echo '<script type="text/javascript">'
   		. 'window.location.href = "device_rc.php?flag=5";'
   		. '</script>';	
	
?>