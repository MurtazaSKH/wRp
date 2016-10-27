<!DOCTYPE html>
<html lang="en">
<head>
<title>Password Retrieval</title>
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
			<div class="grid_3"><a href="index.php" id="logo" class="float_left">weRplay Apps</a></div>
		</div><!-- Header End -->
		<div class="clear"></div>
            
            <div id="infoBar" hidden="false">
            <div class="information grid_12"><h3>Please wait while your request is processed.</h3></div>
            </div>
            
            <div id="confirmationBar" hidden="true">
            <div class="success grid_12"><h3>Your password has been emailed to you. <a href="index.php">Click Here</a> to go back to login screen.</h3></div>
            </div>
            
            <div id="errorBar" hidden="true">
            <div class="error grid_12"><h3>Unable to send the confirmation email. Please contact the administrator. 
            <a href="index.php">Click Here</a> to go back to login screen.</h3></div>
            </div>
            
            <div id="invalidEmail" hidden="true">
            <div class="error grid_12"><h3>Invalid email address entered.
            <a href="passwordRetrieval.php">Click Here</a> to go back.</h3></div>
            </div>
            
		<div id="body">
		</div>
	</div><!-- Body Wrapper End -->
</body>
</html>

<?php
	$email = $_POST['emailAddress'];
	
	//get the password via email address
	include("mysqlConnect.php");
	$query = "SELECT Password FROM employeeinfo WHERE Email = '$email'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
	$password = $row['Password'];
		
	/* These are the variable that tell the subject of the email and where the email will be sent.*/
	$emailSubject = 'apps.weRplay Password';
	$mailto = $email;

	$body = "A password reset request has been requested by your email ID. Your password is listed below. Please report to admin if you did not submit a request. <br/>"
	. "Password: " . $password
	. "<br/><br/>weRplay Support Team";

	$headers = "From: raheel@werplay.com\r\n"; // This takes the email and displays it as who this email is from.
	$headers .= "Content-type: text/html\r\n"; // This tells the server to turn the coding into the text.
	
	try
	{
		if($password=="" || $password== NULL)
		{
			echo '<script type="text/javascript">'
		   . 'document.getElementById("infoBar").hidden = true;'
   		   . 'document.getElementById("invalidEmail").hidden = false;'
		   . '</script>';
		}
		else
		{
			$success = mail($mailto, $emailSubject, $body, $headers); // This tells the server what to send.
			
			if($success)
			{
				echo '<script type="text/javascript">'
			   . 'document.getElementById("infoBar").hidden = true;'
			   . 'document.getElementById("confirmationBar").hidden = false;'
			   . '</script>';
			}//end of if
			else
			{
				echo '<script type="text/javascript">'
			   . 'document.getElementById("infoBar").hidden = true;'
			   . 'document.getElementById("errorBar").hidden = false;'
			   . '</script>';
			}//end of else
		}
		
		
	}//end of try
	catch(Exception $e)
	{
		echo '<script type="text/javascript">'
		   . 'document.getElementById("infoBar").hidden = true;'
		   . 'document.getElementById("errorBar").hidden = false;'
		   . '</script>';
	}//end of catch

?>