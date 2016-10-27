<?php
	session_start();
	
	include("mysqlConnect.php");
	
	$userID = 0;
	if(isset($_SESSION['ID']) == true)
	{
		$userID = $_SESSION['ID'];
		
		//get Employee name via EID
		$query = "SELECT Name FROM employeeinfo WHERE EID = '$userID'";
		$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$userName = $row['Name'];
		
		//get Employee designation via EID
		$query = "SELECT DsgID FROM employeedesignation WHERE EID = '$userID'";
		$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$dsgID = $row['DsgID'];
	}//end of if

	mysqli_close($db);
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