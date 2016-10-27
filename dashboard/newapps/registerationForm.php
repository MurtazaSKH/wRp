<?php
	include('header.php');
	$_SESSION['ID'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Registration</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
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

<body class="login-body">

<div class="container">

<?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)
				{
					echo "<div class=\"alert alert-block alert-danger fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>E-Mail already in use.</strong> Please try again with another E-mail ID.";
                    echo "</div>";
				}//end of inner if
				if($_GET['flag'] == 2)
				{
					echo "<div class=\"alert alert-info fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "Please enter the CAPTCHA correctly.";
                    echo "</div>";
				}//end of inner if
			}//end of outer if
		?>
        <div id="errorDiv" hidden="true">
        
         <div class="alert alert-warning fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                               <div class="error grid_12"> <p id="errorLabel"></p></div>
                            </div>
        </div>

    <form class="form-signin" name="registerationForm" action="processRegisteration.php" onSubmit="return validateRegisterationForm()" method="POST">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Registration</h1>
            <img src="images/login-logo.png" alt=""/>
        </div>


        <div class="login-wrap">
            <p>Enter your personal details below</p>
            <input type="text" autofocus placeholder="Employee ID - Leave if it is unknown" class="form-control" name="EID" id="EID" >
            <input type="text" autofocus placeholder="First Name" class="form-control" name="fName" id="fName">
            <input type="text" autofocus placeholder="Last Name" class="form-control name="lName" id="lName"">
            <input type="text" autofocus placeholder="Email" class="form-control" name="eAddress" id="eAddress">
            <input type="text" autofocus placeholder="Confirm Email" class="form-control" name="ceAddress" id="ceAddress">
            <input type="password" placeholder="Password" class="form-control" name="password" id="password">
            <input type="password" placeholder="Re-type Password" class="form-control" name="cPassword" id="cPassword">
            
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
                     <label>Designation:</label>
							<select style="width: 300px;" id="dsgList" name="dsgList" disabled="true">
								<option>None</option>
							</select>
                           <?php
                        require_once('recaptchalib.php');
                        $publickey = "6LdQaNgSAAAAAMAjWyqGRy78YEfUWaxdio6GDtlb";
                        echo recaptcha_get_html($publickey);
						?> 
            
            <button type="submit" class="btn btn-lg btn-login btn-block">
                <i class="fa fa-check"></i>
            </button>

            <div class="registration">
                Already Registered.
                <a href="index.php" class="">
                    Login
                </a>
            </div>

        </div>

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

</body>
</html>
