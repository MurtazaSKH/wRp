<?php
	session_start();
	if(isset($_SESSION['ID']) == false)
	{
		$loc = 'index.php?flag=2';
		header("Location: $loc");
		die(0);
	
		echo'<noscript>'
		.'<meta http-equiv="refresh" content="1; URL=index.php?flag=4" />'
		.'</noscript>';
	
		echo '<script type="text/javascript">'
		   . 'window.location.href = "index.php?flag=4";'
		   . '</script>';
	}//end of if
	
	$userID = $_SESSION['ID'];
	$userName = $_SESSION['userName'];
	$company = $_SESSION['company'];
	$avatarPath = $_SESSION['AvatarPath'];
?>