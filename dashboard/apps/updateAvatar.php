<?php
	include("sessionHeader.php");
	
	$avatarURL = $_POST['newURL'];
	
	include("mysqlConnect.php");
	
	$query = "UPDATE employeeinfo SET AvatarPath = '$avatarURL' WHERE EID = '$userID'";
	mysql_query($query) or die('Query failed: ' . mysql_error());
	
	mysql_close($db);
	
	$avatarPath = $avatarURL;
	$_SESSION['AvatarPath'] = $avatarURL;
	
	echo '<script type="text/javascript">'
   . 'window.location.href = "settings.php?flag=8";'
   . '</script>';
?>