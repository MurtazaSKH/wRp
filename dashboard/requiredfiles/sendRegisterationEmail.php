<?php
	$EID = $_GET['id'];
	$to= $_GET['to'];
		
	/* These are the variable that tell the subject of the email and where the email will be sent.*/
	$emailSubject = 'House of QA - Account Activation';
	$mailto = $to;

	$body = "Thank you for registering. We need your suggestions to make our application better. <br/>"
	. "<a href='www.houseofqa.com/dashboard/process/activateAccount.php?activationcode=". $EID."&id=".$to. 
	"'>Click Here</a> to activate your account."
	. "<br/><br/>House of QA - Support Team";

	$headers = "From: hammad@werplay.com\r\n"; // This takes the email and displays it as who this email is from.
	$headers .= "Content-type: text/html\r\n"; // This tells the server to turn the coding into the text.
	
	try
	{
		$success = mail($mailto, $emailSubject, $body, $headers); // This tells the server what to send.

		if($success)
		{
			echo '<script type="text/javascript">'
		   . 'window.location.href = "../register.php";'
		   . '</script>';
		}//end of if
		else
		{
			echo '<script type="text/javascript">'
		   . 'document.getElementById("infoBar").hidden = true;'
		   . 'document.getElementById("errorBar").hidden = false;'
		   . '</script>';
		}//end of else
	}//end of try
	catch(Exception $e)
	{
		echo '<script type="text/javascript">'
		   . 'document.getElementById("infoBar").hidden = true;'
		   . 'document.getElementById("errorBar").hidden = false;'
		   . '</script>';
	}//end of catch

?>