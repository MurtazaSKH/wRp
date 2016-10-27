<?php
	// needs to be changed according to server when used online, localhost can remain as it is.
	$db = mysql_connect('localhost', 'root', 'root') or die('Could not connect: ' . mysql_error()); 
	mysql_select_db('werplayc_apps') or die('Could not select database');
?>