<?php
	$db = mysqli_connect('localhost', 'root', 'root','wrp_devicePortal') or die('Could not connect: ' . mysqli_connect_error()); 
	// mysql_select_db('werplayc_apps') or die('Could not select database');

	if ($db->connect_error) {
	   echo "Not connected, error: " . $mysqli_connection->connect_error;
	}
	else {
	   echo "Connected.";
	}
	$rand = rand(0,9999);

	// ALTER TABLE `employee` ADD `PIN` INT(4) NOT NULL DEFAULT '00000' AFTER `Name`;
	
	$sql2 = " update employee set PIN='$rand' where 1";
	if(mysqli_query($db,$sql2))
	{
		echo "Query2: success";
	}
	else
	{
		echo mysqli_error($db);
	}
?>