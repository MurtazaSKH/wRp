<?php
	include('checkSession.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Processing Registeration...</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="data/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="data/js/ui/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="data/js/jquery.corner.js"></script>
<script type="text/javascript" src="data/js/jquery.validate.js"></script>
<script type="text/javascript" src="data/js/css_browser_selector.js"></script>
<script type="text/javascript" src="data/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="data/js/editor/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="data/js/calendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="data/js/jquery.multiselect.min.js"></script>
<script type="text/javascript" src="data/js/tooltip/jquery.tipsy.js"></script>
<script type="text/javascript" src="data/js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="data/js/validation/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="data/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="data/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="data/js/fancybox/jquery.easing-1.4.pack.js"></script>
<script type="text/javascript" src="data/js/js.js"></script>
<link rel="stylesheet" href="data/css/reset.css" type="text/css" />
<link rel="stylesheet" href="data/css/grid.css" type="text/css" />
<link rel="stylesheet" href="data/css/style.css" type="text/css" />
<link rel="stylesheet" href="data/js/plugins.css" type="text/css" />
</head>
<body>
	<div id="main" class="container_12"><!-- Body Wrapper Begin -->
		<div id="header"><!-- Header Begin -->
			<div class="grid_3"><a href="#" id="logo" class="float_left">AdminCP</a></div>
		</div><!-- Header End -->
		<div class="clear"></div>
		<div class="information grid_12"><h3>Please wait while your information is processed</h3></div><!-- Notification -->
		<div id="body">
		</div>
	</div><!-- Body Wrapper End -->
</body>
</html>

<?php

	require_once('recaptchalib.php');
	$privatekey = "6LdQaNgSAAAAAMWGASLMM8U392UDXaJv-5tvsLlj";
	$resp = recaptcha_check_answer ($privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) 
	{
		// What happens when the CAPTCHA was entered incorrectly
		echo '<script type="text/javascript">'
	   . 'window.location.href = "registerationForm.php?flag=2";'
	   . '</script>';
	}
	else
	{	
		$EID = $_POST['EID'];
		$fName = $_POST['fName'];
		$lName = $_POST['lName'];
		$eAddress = $_POST['eAddress'];
		$password = $_POST['password'];
		$dsgn = $_POST['dsgList'];
		
		include("mysqlConnect.php");
		
		$query = "SELECT Email FROM employeeinfo";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$num_results = mysql_num_rows($result);
	
		$flag = false;
		
		for($i=0; $i<$num_results; $i++)//check if the email is already in use
		{
			$row = mysql_fetch_array($result);
			if(strcmp($row['Email'], $eAddress) == 0)
			 {
				$flag = true;
				break;
			 }//end of if
		}//end of while
		
		if($flag == true)//if the email is indeed in use
		{		
			echo '<script type="text/javascript">'
				   . 'window.location.href = "registerationForm.php?flag=1";'
				   . '</script>';
		}//end of if
		if($flag == false)//if the info is unique
		{
			$fullName = $fName . " " . $lName;
			
			//insert the employee data in DB
			$query = "INSERT INTO employeeinfo(EmployeeID, Name, Email, Password)
			VALUES ('$EID', '$fullName', '$eAddress', '$password');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//get the EID of added employee
			$query = "SELECT EID FROM employeeinfo WHERE Email = '$eAddress'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$num_results = mysql_num_rows($result);
			
			$desgEID = 0;//EID of the added employee
			for($i=0; $i<$num_results; $i++)
			{
				$row = mysql_fetch_array($result);
				$desgEID = $row['EID'];
			}//end of for
			
			//insert empoyee designation to DB
			$query = "INSERT INTO employeedesignation(EID, DsgID) VALUES ('$desgEID', '$dsgn');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//insert account as inactive
			$query = "INSERT INTO accountactive(EID, Active) VALUES ('$desgEID', '0');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//sendConfirmationEmail($desgEID, $eAddress);
			echo '<script type="text/javascript">'
				   . 'window.location.href = "sendRegisterationEmail.php?eid='.$desgEID.'&to='.$eAddress.'";'
				   . '</script>';
		}//end of if
		
		mysql_close($db);
		
	}//end of CAPTCHA check else
?>