<?php
	 
include("sessionHeader.php");
include("mysqlConnect.php");
	
	$sid = $_REQUEST['c'];
	
	$todo = $_REQUEST['q'];
	
				
/*$query = "SELECT DsgID FROM operationrights WHERE AppName = 'DeviceRecords' AND RightName = 'Basic'";




$result = mysql_query($query) or die('Query failed: ' . mysql_error());*/

If  ( $sid == 1)
{

$query = "SELECT TOID FROM todolist where EID = $userID ORDER BY TOID";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$num_results = mysql_num_rows($result);	

echo $num_results;

$j = 0;

	while ($row = mysql_fetch_array($result))
	{
		
		$j = $j +1;
		
		echo "value:".$row[0];
		
		$gh = $row[0];
	
		if ($todo == $j)
		{
			$query = "DELETE FROM todolist where TOID = $gh ORDER BY TOID";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		}
	}
}

if ( $sid == 2 )
{
$query = "INSERT INTO todolist (Todo, EID, Checktodo) VALUES ('$todo', '$userID', '1')";
mysql_query($query) or die('Query failed: ' . mysql_error());
}
?>