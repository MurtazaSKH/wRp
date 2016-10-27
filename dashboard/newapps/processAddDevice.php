<?php
	include("header.php");
		
	$deviceName = $_POST['deviceName'];
	$osType = $_POST['osType'];
	$pType = $_POST['pType'];
	$osVersion = $_POST['osVersion'];
	$dids = $_POST['dids'];
	$imei = $_POST['imei'];
	$vendor = $_POST['vendor'];
	$resolution = $_POST['resolution'];
	
	include("mysqlConnect.php");
	
	if ($deviceName == "" || $osType == "" || $osVersion == "" || $dids == "" || $imei == "" || $pType == "" || $vendor == "" || $resolution == "")	//check for empty fields
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "adddevice.php?flag=3";'
	   . '</script>';
	}//end of if
	else
	{
		//check for duplicates
		$query = "SELECT * FROM devicelist";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$num_results = mysql_num_rows($result);	
		$row = NULL;
		$bInsertCheck = 1;
		
		for($i = $num_results; $i > 0 ; $i--)
		{
			 $row = mysql_fetch_array($result);
			 
			 if($row['DeviceName'] == $deviceName)
			 {
				 echo '<script type="text/javascript">'
			   . 'window.location.href = "addevice.php?flag=4";'
			   . '</script>';
			   
			   $bInsertCheck = 0;
			 }//end of if
		}//end of for
		
		if($bInsertCheck == 1)
		{
			$query = "INSERT INTO devicelist(ostype, osversion, devicename, DIDs, EMEI, Resolution, Vendor, Priority) VALUES ('$osType', '$osVersion', '$deviceName', '$dids', '$imei', '$resolution', '$vendor', '$pType')";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "device_rc.php?flag=6";'
		   . '</script>';
		}//end of if
	}//end of outer else
	
	mysql_close($db);
?>