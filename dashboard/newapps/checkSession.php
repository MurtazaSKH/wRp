<?php
	//session_start();
	if(isset($_SESSION['ID']) == false)
	{
		echo'<noscript>'
		.'<meta http-equiv="refresh" content="1; URL=index.php?flag=2" />'
		.'</noscript>';
		echo '<script type="text/javascript">'
		   . 'window.location.href = "index.php?flag=2";'
		   . '</script>';
	}//end of if
?>