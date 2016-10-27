<?php
	 
include("sessionHeader.php");
include("mysqlConnect.php");
	
	$sid = $_REQUEST['c'];
	
	$todo = $_REQUEST['q'];
	
				
/*$query = "SELECT DsgID FROM operationrights WHERE AppName = 'DeviceRecords' AND RightName = 'Basic'";




$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));*/

If  ( $sid == 1)
{

$query = "SELECT TOID FROM todolist where EID = $userID ORDER BY TOID";
$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
$num_results = mysqli_num_rows($result);	

echo $num_results;

$j = 0;

	while ($row = mysqli_fetch_array($result))
	{
		
		$j = $j +1;
		
		echo "value:".$row[0];
		
		$gh = $row[0];
	
		if ($todo == $j)
		{
			$query = "DELETE FROM todolist where TOID = $gh ORDER BY TOID";
			$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
		}
	}
}

if ( $sid == 2 )
{
$query = "INSERT INTO todolist (Todo, EID, Checktodo) VALUES ('$todo', '$userID', '1')";
mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
}
?>