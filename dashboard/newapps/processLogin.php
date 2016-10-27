<?php
	session_start();
	$_SESSION['ID'] = 0;
	
?>

<html>
	<head>
    </head>
    <body>
    	<?php
			$row = NULL;
			$ID = 0;
			$password = NULL;
			
			include("mysqlConnect.php");
			
			$procedure = $_POST['arg'];
			
			$EMAIL 	= $_POST['email1'];
			
			if (!$_POST['email1'])
			  {
			  	$EMAIL = $_GET['email'];
			  	$ght = 4311;
			  }
			$PASS 	= $_POST['password'];
		
			
			//get the EID and password
			$query = "SELECT EID,Password FROM employeeinfo WHERE LOWER(Email) = LOWER('$EMAIL')";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row = mysql_fetch_array($result);
			$ID = $row['EID'];
			$password = $row['Password'];
			
		
			//check if account has been activated
			$acctStatus= NULL;
			if($ID != NULL || $ID != "")
			{
				$query = "SELECT Active FROM accountactive WHERE EID = '$ID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$row = mysql_fetch_array($result);
				$acctStatus = $row['Active'];
			}//end of if
		
			if ($ID == NULL || $ID == "")//account existance check
			{
				echo '<script type="text/javascript">'
			   . 'window.location.href = "index.php?flag=4";'
			   . '</script>';
			}
			elseif ($PASS== "" || $PASS != $password )//password check
			{
				echo '<script type="text/javascript">'
			   . 'window.location.href = "index.php?flag=1";'
			   . '</script>';
			}//end of else
			elseif ($acctStatus == '0')//account active check
			{
				echo '<script type="text/javascript">'
			   . 'window.location.href = "index.php?flag=3&email='.$EMAIL.'&eid='.$ID.'";'
			   . '</script>';
			}//end of elseif
			else//get required info put it in session and redirect to account home
			{
				//get employee name
				$query = "SELECT Name, AvatarPath FROM employeeinfo WHERE EID = '$ID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$row = mysql_fetch_array($result);
				$userName = $row['Name'];
				$_SESSION['userName'] = $userName;
				
				//get the avatar image
				$avatar = $row['AvatarPath'];
				if($avatar == "" || $avatar == NULL)
				{
					$_SESSION['AvatarPath'] = "images/test_avatar.png";
				}//end of if
				else
				{
					$_SESSION['AvatarPath'] = $avatar;
				}//end of else
				
				//get Employee designation via EID
				$query = "SELECT DsgID FROM employeedesignation WHERE EID = '$ID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$row = mysql_fetch_array($result);
				$dsgID = $row['DsgID'];
				$_SESSION['dsgID'] = $dsgID;
				
				//get designation name
				$query = "SELECT DsgName FROM designations WHERE DsgID = '$dsgID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$row = mysql_fetch_array($result);
				$dsgName = $row['DsgName'];
				$_SESSION['dsgName'] = $dsgName;
				
				//get department ID
				$query = "SELECT DeptID FROM designations WHERE DsgID = '$dsgID'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$row = mysql_fetch_array($result);
				$deptID = $row['DeptID'];
				$_SESSION['deptID'] = $deptID;
	
				$_SESSION['ID'] = $ID;	//set the session ID
										
			if ($ght == 4311)
			{					
				echo '<script type="text/javascript">'
			   . 'window.location.href = "homepage.php?flag=5";'
			   . '</script>';						
			}
									
				echo '<script type="text/javascript">'
			   . 'window.location.href = "homepage.php";'
			   . '</script>';
			}//end of else
			
			mysql_close($db);
		?>
    </body>
</html>