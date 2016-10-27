<?php
	include("sessionHeader.php");
	
	$rightsID = $_GET['rid'];
	
	include("mysqlConnect.php");
	$query = "DELETE FROM operationrights WHERE RID = $rightsID";
	mysql_query($query) or die('Query failed: ' . mysql_error());
	mysql_close($db);
	
	echo '<script type="text/javascript">'
	   . 'window.location.href = "admin_appRights.php?flag=5";'
	   . '</script>';
?>