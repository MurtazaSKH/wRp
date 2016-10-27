<?php
	include('header.php');
	$_SESSION['ID'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Registeration</title>
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
<link rel="shortcut icon" href="img/favicon.ico" />
<script type="text/javascript">
	
	//bool type flags for verification
	var fEID = false;
	var fFName = false;
	var fLName = false;
	var fEMail = false;
	var fCfmEMail = false;
	var fPass = false;
	var fCfmPass = false;
	var fDept = false;
	var fDsg = false;
	
	function checkAllValidationFlags()
	{
		if(fFName == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Please enter your first name";
			return false;
		}
		if(fLName == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Please enter your last name";
			return false;
		}
		if(fEMail == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Please enter a valid email address";
			
			return false;
		}
		if(fCfmEMail == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Emails do not match";
			
			return false;
		}
		if(fPass == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Password should be between 5 and 12 characters";
			
			return false;
		}
		if(fCfmPass == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Passwords do not match";
			
			return false;
		}
		if(fDept == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Please select a department";
			
			return false;
		}
		if(fDsg == false)
		{
			document.getElementById("errorDiv").hidden = false;
			document.getElementById("errorLabel").innerHTML = "Please select a designation";
			
			return false;
		}
		
		return true;
		
	}//end of checkAllValidationFlags function
	
	function validateRegisterationForm()
	{
		var fName = document.forms["registerationForm"]["fName"].value;
		var lName = document.forms["registerationForm"]["lName"].value;
		var eAddress = document.forms["registerationForm"]["eAddress"].value;
		var ceAddress = document.forms["registerationForm"]["ceAddress"].value;
		var password = document.forms["registerationForm"]["password"].value;
		var cPassword = document.forms["registerationForm"]["cPassword"].value;
		var departmentName = document.forms["registerationForm"]["departmentName"].value;
		var dsgList = document.forms["registerationForm"]["dsgList"].value;
		
		if (fName == null || fName != "")
		{
			fFName = true;
		}
		if (lName == null || lName != "")
		{
			fLName = true;	
		}
		if(validateEmail(eAddress) == true)
		{
			fEMail = true;
		}
		if(eAddress.toUpperCase() == ceAddress.toUpperCase())
		{
			fCfmEMail = true;
		}
		if(password.length > 5 && password.length < 13)
		{
			fPass = true;
		}
		if(cPassword == password)
		{
			fCfmPass = true;
		}
		if(departmentName != "None" && departmentName != "0")
		{
			fDept = true;
		}
		if(dsgList != "None" && dsgList != "0")
		{
			fDsg = true;
		}
		
		if (checkAllValidationFlags() == false)
			return false;
		else
			return true;
	}//end of validate registeration form
	
	function validateEmail(userEmail)
	{	
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		
		try
		{
			var splitEmail = userEmail.split("@");
			var splitEmail2 = splitEmail[1].split(".");
			var emailDomain = splitEmail2[0];
		}
		catch(err)
		{
			return false;
		}
		
		if(pattern.test(userEmail) != true && emailDomain != "werplay")
		{
			return false;
		}
	
		return true;
	}//end of validateEmail function
	
	//get AJAX working
	function getXMLHttp()
	{
	  var xmlHttp
	
	  try
	  {
		//Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	  }
	  catch(e)
	  {
		//Internet Explorer
		try
		{
		  xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
		  try
		  {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  catch(e)
		  {
			alert("Your browser does not support AJAX!")
			return false;
		  }
		}
	  }
	  return xmlHttp;
	}//end of getXMLHttp function
	
	//gets the complete list of designations
	function getDesignationList(selDept)
	{
		//get the selected department ID
		var deptID = selDept.options[selDept.selectedIndex].value;
		
		var xmlHttp = getXMLHttp();
	  
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  getDesignationList_HandleResponse(xmlHttp.responseText);
		}
	  }

	  xmlHttp.open("GET", "getDesignationList.php?deptid="+deptID, true);
	  xmlHttp.send(null);
	}
	
	function getDesignationList_HandleResponse(response)
	{
		var dsgList = document.getElementById("dsgList");
		dsgList.options.length = 0;	//remove all elements from the list
		dsgList.options[dsgList.options.length] = new Option("None", "0");//add the first dummy element
		
		var allIds = response;
		var idTokens = allIds.split( "&" );
		for ( var i = 0; i < idTokens.length - 1 ; i++ )
		{			
			var desSplit = idTokens[i].split("-");
			dsgList.options[dsgList.options.length] = new Option(desSplit[1], desSplit[0]);
		}//end of for
		
		document.getElementById("dsgList").disabled = false;
	}//end of response handler
	
	function disableSubmitButton()
	{
		document.getElementById("btn_Register").disabled= true;
	}//end of disableSubmitButton function
	</script>

</head>
<script class="code" type="text/javascript"><!-- Plugin Examples -->
$(document).ready(function(){
	$('#datepicker').datepicker();
	
	$('.checkboxui, .radioui').buttonset();
	
	$('#slider').slider({ values: [20,50], range: true });
	
});
</script>
<body>
	<div id="main" class="container_12"><!-- Body Wrapper Begin -->
		<div id="header"><!-- Header Begin -->
			<div class="grid_3"><a href="index.php" id="logo" class="float_left">weRplay</a></div>
			
		</div><!-- Header End -->

        <div class="clear"></div>
        <?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)
				{
					echo "<div class='error grid_12'><h3>Email already in use. Please try again</h3><a href='#' class='hide_btn'>&nbsp;</a></div>";
				}//end of inner if
				if($_GET['flag'] == 2)
				{
					echo "<div class='error grid_12'><h3>Please enter the CAPTCHA correctly</h3><a href='#' class='hide_btn'>&nbsp;</a></div>";
				}//end of inner if
			}//end of outer if
		?>
        <div id="errorDiv" hidden="true">
			<div class="error grid_12"><h3 id="errorLabel"></h3><a href="#" class="hide_btn">&nbsp;</a></div>
        </div>
        
		<div id="body">
			<div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Registeration Form</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<form class="form" name="registerationForm" action="processRegisteration.php" onSubmit="return validateRegisterationForm()" method="POST">
                    
						<div class="form_row"><label>Employee ID:</label><input class="input" type="text" style="width: 290px;" name="EID" id="EID" placeholder="Leave Blank if Unknown" original-title="Leave blank if unknown" /></div>
						<br/>
						<div class="form_row"><label>First Name:</label><input class="input validate[required] tipRight" type="text" style="width: 290px;" name="fName" id="fName" placeholder="First Name" /></div>
                        
                        <div class="form_row"><label>Last Name:</label><input class="input validate[required] tipRight" type="text" style="width: 290px;" name="lName" id="lName" placeholder="Last Name" /></div>
                        <br/>
                        <div class="form_row"><label>Email Address:</label><input class="input validate[required] tipRight" type="text" style="width: 290px;" name="eAddress" id="eAddress" placeholder="Email Address" /></div>
                        
                        <div class="form_row"><label>Confirm Email:</label><input class="input validate[required] tipRight" type="text" style="width: 290px;" name="ceAddress" id="ceAddress" placeholder="Confirm Email Address" /></div>
                        <br/>
                        <div class="form_row"><label>Password:</label><input class="input validate[required] tipRight" type="password" style="width: 290px;" name="password" id="password" placeholder="Password" /></div>
                        
                        <div class="form_row"><label>Confirm Password:</label><input class="input validate[required] tipRight" type="password" style="width: 290px;" name="cPassword" id="cPassword" placeholder="Confirm Password" /></div>
                        
                        <br/>
						<div class="form_row">
                        <?php
							include("mysqlConnect.php");
							
							$query = "SELECT DeptID, DeptName FROM departments";
							$result = mysql_query($query) or die('Query failed: ' . mysql_error());
							$num_results = mysql_num_rows($result);	
							$row = NULL;
							
							echo "<label>Department</label>";
							echo "<select class='select' style='width: 300px;' id='departmentName' name='departmentName' onChange='getDesignationList(this)'>";
							echo "<option value='0'>" . "None" . "</option>";
							for($i = $num_results; $i > 0 ; $i--)
							{
								 $row = mysql_fetch_array($result);
								 echo "<option value='" . $row['DeptID'] . "'>" . $row['DeptName'] . "</option>";
							}//end of for
							echo "</select>";
							
							mysql_close($db);
						?>  
                        <div class="form_row">
							<label>Designation:</label>
							<select style="width: 300px;" id="dsgList" name="dsgList" disabled="true">
								<option>None</option>
							</select>
						</div><br/>
						
                        <div class="form_row">
                        <?php
                        require_once('recaptchalib.php');
                        $publickey = "6LdQaNgSAAAAAMAjWyqGRy78YEfUWaxdio6GDtlb";
                        echo recaptcha_get_html($publickey);
						?>
                        </div>
                        
						<div class="clear"></div><br />
						<div class="form_row">
                        <input type="submit" id="btn_Register" class="submit" value="Submit" />
                        </div>
					</form>
				</div>
			</div><!-- Block End -->
		</div>
	</div><!-- Body Wrapper End -->
</body>
</html>