<?php
	include("sessionHeader.php");
		
	include("mysqlConnect.php");
	
	if ($_GET['pager'])
	$pager = $_GET['pager'];
	
	
	if($_GET['flag'] == 'disown')//clear devices against user's name
	{
		mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE checkoutlog SET checkedin = now(), checked = '0' WHERE OwnedBy = '$userName'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$query = "UPDATE devicelist SET OwnedBy = '' WHERE OwnedBy = '$userName'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		
		
		if ($pager == 3213)
			{
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?flag=2";'
		   . '</script>';
			
			}
		
		echo '<script type="text/javascript">'
	   . 'window.location.href = "device_rc.php?flag=2";'
	   . '</script>';
	}//end of if
	elseif($_GET['flag'] == 'delete')//Delete a device
	{
		$deviceID = $_GET['deviceid'];
		$query = "DELETE from devicelist WHERE DeviceID = '$deviceID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
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
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
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
		mysql_query($query) or die('Query failed: ' . mysql_error());
		mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE devicelist SET LastUpdate = now() WHERE DeviceID = '$deviceID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$query = "SELECT LastUpdate FROM devicelist 
			WHERE DeviceID = '$deviceID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_row($result);

		$query = "SELECT OwnedBy FROM devicelist 
			WHERE DeviceID = '$deviceID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row2 = mysql_fetch_row($result);
		
		if ($row2[0] != 'Charging')
		{
			mysql_query('SET time_zone = Asia/Karachi');
			$query = "UPDATE checkoutlog SET checkedin = now(), checked = '0' WHERE OwnedBy = '$userName'";
			mysql_query($query) or die('Query failed: ' . mysql_error());
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
		mysql_query($query) or die('Query failed: ' . mysql_error());
		mysql_query('SET time_zone = Asia/Karachi');
		$query = "UPDATE devicelist SET LastUpdate = now() WHERE DeviceID = '$deviceID'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$query = "SELECT DeviceName FROM devicelist WHERE DeviceID = '$deviceID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_row($result);
		mysql_query('SET time_zone = Asia/Karachi');
		
		$query = "INSERT INTO checkoutlog VALUES ('$row[0]', '$userName', now(), now(),'1')";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
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
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
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
			//change the device ownership
			$query = "UPDATE devicelist SET OwnedBy = '$uName', LastUpdate = now() WHERE DeviceName = '$dName'";

			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//insert into device log
			$query = "INSERT INTO checkoutlog VALUES ('$dName', '$uName', now(), now(),'1')";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			
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