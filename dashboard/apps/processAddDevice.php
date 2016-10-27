<?php
	include("header.php");
		
	$deviceName = $_POST['deviceName'];
	$osType = $_POST['osType'];
	$osVersion = $_POST['osVersion'];
	$dids = $_POST['dids'];
	
	include("mysqlConnect.php");
	
	if ($deviceName == "" || $osType == "" || $osVersion == "")	//check for empty fields
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "alterRecords.php?flag=3";'
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
			   . 'window.location.href = "alterRecords.php?flag=4";'
			   . '</script>';
			   
			   $bInsertCheck = 0;
			 }//end of if
		}//end of for
		
		if($bInsertCheck == 1)
		{
			$query = "INSERT INTO devicelist(ostype, osversion, devicename, DIDs) VALUES ('$osType', '$osVersion', '$deviceName', '$dids')";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "drec_home.php?flag=6";'
		   . '</script>';
		}//end of if
	}//end of outer else
	
	mysql_close($db);
?>