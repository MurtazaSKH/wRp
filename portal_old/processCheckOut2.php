<?php
	include("sessionHeader.php");
		
	include("mysqlConnect.php");
	
	if ($_GET['pager'])
	$pager = $_GET['pager'];
	
	
	if($_GET['flag'] == 'disown')//clear devices against user's name
	{
		// get the checkout time to add in device log
		$sql1 = "SELECT LastUpdate FROM devicelist WHERE DeviceName='$dName' limit 1";
		$result1 = mysql_query($sql1);
		$checkouttime = mysql_fetch_object($result1);
		echo $checkouttime;

		//mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE checkoutlog SET checkedin = now() + INTERVAL 5 HOUR,DateOwned='$checkouttime' , checked = '0' WHERE OwnedBy = '$userName'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		$query = "UPDATE devicelist SET OwnedBy = '' WHERE OwnedBy = '$userName'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		
		
		// if ($pager == 3213)
		// 	{
			
		// 	echo '<script type="text/javascript">'
		//    . 'window.location.href = "homepage.php?flag=2";'
		//    . '</script>';
			
		// 	}
		
		// echo '<script type="text/javascript">'
	 //   . 'window.location.href = "device_rc.php?flag=2";'
	 //   . '</script>';
	}//end of if
	elseif($_GET['flag'] == 'delete')//Delete a device
	{
		$deviceID = $_GET['deviceid'];
		$query = "DELETE from devicelist WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=9";'
		   . '</script>';
			
			}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=9";'
	   . '</script>';
	}//end of elseif
	elseif($_GET['flag'] == 'clearAll')//clear all posessions
	{
		$query = "UPDATE devicelist SET OwnedBy = ''";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=3";'
		   . '</script>';
			
			}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=3";'
	   . '</script>';
	}//end of elseif
	elseif($_GET['flag'] == 'disownid')
	{
		$deviceID = $_GET['did'];
		
		$query = "UPDATE devicelist SET OwnedBy = '' WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		//mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE devicelist SET LastUpdate = now() + INTERVAL 5 HOUR WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		$query = "SELECT LastUpdate FROM devicelist 
			WHERE DeviceID = '$deviceID'";
		$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$query = "SELECT OwnedBy FROM devicelist 
			WHERE DeviceID = '$deviceID'";
		$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		$row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		if ($row2[0] != 'Charging')
		{
			//mysql_query('SET time_zone = Asia/Karachi');
			$query = "UPDATE checkoutlog SET checkedin = now() + INTERVAL 5 HOUR, checked = '0' WHERE OwnedBy = '$userName'";
			mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		}
		
		if ($pager == 3213)
		{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=4";'
		   . '</script>';
			
		}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=4";'
	   . '</script>';
	}
	elseif($_GET['flag'] == 'checkoutid')
	{
		$deviceID = $_GET['did'];
		
		$query = "UPDATE devicelist SET OwnedBy = '$userName' WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		//mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE devicelist SET LastUpdate = now() + INTERVAL 5 HOUR WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		$query = "SELECT DeviceName FROM devicelist WHERE DeviceID = '$deviceID'";
		$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		//mysql_query('SET time_zone = Asia/Karachi');
		
		// $query = "INSERT INTO checkoutlog VALUES ('$row[0]', '$userName', now() + INTERVAL 5 HOUR, now() + INTERVAL 5 HOUR,'1')";
		// mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=8";'
		   . '</script>';
			
			}
			
		if ($pager == 32133)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "deviceCheckout.php?flag=8";'
		   . '</script>';
			
			}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=8";'
	   . '</script>';
	}
	elseif($_GET['flag'] == 'charge')
	{
		$deviceID = $_GET['did'];
		
		$query = "UPDATE devicelist SET OwnedBy = 'Charging' WHERE DeviceID = '$deviceID'";
		mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		
		if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=4";'
		   . '</script>';
			
			}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=7";'
	   . '</script>';
	}
	else//update owndership of a device
	{
		$dName = $_POST['deviceName'];
		if (!$_POST['deviceName'])
		{
		
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
		  
		  <script type="text/javascript">
 		if (window.location.href.match(/\#/)){
		//check if hash tag exists in the URL
		//if(window.location.hash) {
 
		 //set the value as a variable, and remove the #
		 var hash_value = window.location.hash.replace('#', '');
		 urlv = '<?php echo $url ;?>';
 		//show the value with an alert pop-up
 
 		window.location.href = urlv+'-'+hash_value; 
 
		 }
		</script>
			
		<?php
		  
                  

		  $dName = str_replace('-', '#', $_GET['deviceName']);
		 
		  $dName = str_replace(' ', '-', $dName);
		  
		  $dName = str_replace('-', ' ', $dName);
		 
		  $pager = 3213;
		  
		  
		 }
		$uName = $_POST['userName'];
		if (!$_POST['username'])
		  $uName = $userName;
		  
		  mysql_query("SET SESSION time_zone = '+5:00'");		  
		
		if($dName == "No Device")
		{
			echo '<script type="text/javascript">'
		   . 'window.location.href = "checkOut.php?flag=noDevice";'
		   . '</script>';
		}//end of if
		else
		{
			// get the checkout time to add in device log
			$sql1 = "SELECT LastUpdate FROM devicelist WHERE DeviceName='$dName' limit 1";
			$result1 = mysql_query($sql1);
			$checkouttime = mysql_fetch_object($result1);

			//change the device ownership
			$query = "UPDATE devicelist SET OwnedBy = '$uName', LastUpdate = now() + INTERVAL 5 HOUR WHERE DeviceName = '$dName'";

			mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
			
			//insert into device log
			$query = "INSERT INTO checkoutlog VALUES ('$dName', '$uName', '$checkouttime', now() + INTERVAL 5 HOUR,'1')";
			mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
			
			
			if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		     . 'window.location.href = "homepage.php?flag=1";'
		     . '</script>';
		
			}
			
			
			//redirect the user and display success message
			echo '<script type="text/javascript">'
		   . 'window.location.href = "device_rc.php?flag=1";'
		   . '</script>';
		}//end of inner else
	}//end of else
	
	mysql_close($db);
?>