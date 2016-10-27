<?php
	session_start();
	if(isset($_SESSION['ID']) == false)
	{
		echo '<script type="text/javascript">'
		   . 'window.location.href = "index.php?flag=2";'
		   . '</script>';
	}//end of if
	
	$userID = $_SESSION['ID'];
	$userName = $_SESSION['userName'];
	$dsgID = $_SESSION['dsgID'];
	$dsgName = $_SESSION['dsgName'];
	$deptID = $_SESSION['deptID'];
	$avatarPath = $_SESSION['AvatarPath'];
?>