<?php
	session_start();
	
	include("mysqlConnect.php");
	
	$userID = 0;
	if(isset($_SESSION['ID']) == true)
	{
		$userID = $_SESSION['ID'];
		
		//get Employee name via EID
		$query = "SELECT Name FROM employeeinfo WHERE EID = '$userID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_array($result);
		$userName = $row['Name'];
		
		//get Employee designation via EID
		$query = "SELECT DsgID FROM employeedesignation WHERE EID = '$userID'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$row = mysql_fetch_array($result);
		$dsgID = $row['DsgID'];
	}//end of if

	mysql_close($db);
?>
<html>
	<div>
    	<div align="right">
        <?php 
		if(isset($_SESSION['ID']) == true && $_SESSION['ID'] !=0)
		{
			//echo $userName;
			//echo " <a href='index.php'?flag=kill>Logout</a>";
		}//end of if
		else
		{
			//echo "<a href='index.php?flag=kill'>Login</a>";
		}//end of else
		?>
        </div>
    </div>
</html>