<?php
	session_start();
	if(isset($_SESSION['ID']) == false)
	{
		echo '<script type="text/javascript">'
		   . 'window.location.href = "index.php?flag=2";'
		   . '</script>';
	}//end of if
?>