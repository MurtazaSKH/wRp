<?php
	include("sessionHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Settings</title>
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
<script type="text/javascript" src="data/js/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.barRenderer.min.js"></script>
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

function validateUpdateDesignation()
{
	deptName = document.forms["updateDesignationForm"]["departmentName"].value;
	dsgName = document.forms["updateDesignationForm"]["dsgList"].value;
	
	if(deptName == 0)
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Please select a department";

		return false;
	}//end of if
	if(dsgName == 0)
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Please select a designation";

		return false;
	}//end of if
	
	return true;
}

function validateUpdatePassword()
{
	currentPassword = document.forms["updatePasswordForm"]["currentPassword"].value;
	newPassword = document.forms["updatePasswordForm"]["newPassword"].value;
	confirmNewPassword = document.forms["updatePasswordForm"]["confirmNewPassword"].value;
	
	if(currentPassword == "" || newPassword == "" || confirmNewPassword == "")
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Fields cannot be empty";
		
		return false;
	}//end of if
	if(newPassword != confirmNewPassword)
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Passwords do not match";
		
		return false;
	}//end of if
	if(newPassword.length <= 5 || newPassword.length >12)
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Password should be between 5 to 12 characters";
		
		return false;
	}//end of if
	
	return true;
}

function validateUpdateEmployeeID()
{
	newEmployeeID = document.forms["updateEmployeeID"]["newEmployeeID"].value;
	
	if(newEmployeeID == "")
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Field cannot be empty";
		
		return false;
	}//end of if
	
	return true;
}

function validateAvatarURL()
{
	newURL = document.forms["updateAvatar"]["newURL"].value;
	
	if(checkURL(newURL))
	{
		return true;
	}//end of if
	
	document.getElementById("errorDiv").hidden = false;
	document.getElementById("errorLabel").innerHTML = "Please enter a valid URL";

	return false;	
}

function checkURL(url)//image URL verification
{
    return(url.match(/\.(jpeg|jpg|gif|png|JPEG|JPG|GIF|PNG)$/) != null);
}
</script>

</head>
<body>

	<div id="main" class="container_12"><!-- Body Wrapper Begin -->
		<div id="header"><!-- Header Begin -->
			<div class="grid_3"><a href="home.php" id="logo" class="float_left">weRplay Apps</a></div>
			
		</div><!-- Header End -->
		<div class="clear"></div>
		<div id="userbar"><!-- Userbar Begin -->
			<div id="profile"><!-- Profile Begin -->
				<div id="avatar">
					<img src="<?php echo $avatarPath; ?>" alt="Avatar" height="44" width="44" />
				</div>
				<div id="profileinfo">
					<h3 id="username"><?php echo $userName ?></h3>
					<span id="subline"><?php echo $dsgName ?></span>
					<div class="clear"></div>
					<a href="settings.php" class="profilebutton">Profile</a>
					<a href="index.php?flag=kill" class="profilebutton">Logout</a>
				</div>
			</div><!-- Userbar End -->
			<ul id="navigation"><!-- Main Navigation Begin -->
              <li><a href="home.php" class="icon_home">Dashboard</a></li>
                <?php
				include("mysqlConnect.php");
				
				$query = "SELECT DsgID FROM operationrights WHERE AppName = 'DeviceRecords' AND RightName = 'Basic'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$num_results = mysql_num_rows($result);
				$row = NULL;
										
				for($i=0; $i < $num_results ; $i++)
				{
					 $row = mysql_fetch_array($result);
					 $allowedDsgID = $row['DsgID'];
					 
					 if($dsgID == $allowedDsgID)
					 {
						 echo "<li><a href='drec_home.php' class='icon_pictures'>Device Records</a></li>";
					 }//end of if
				}//end of for
				
				mysql_close($db);
				?>
                
				<li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
			</ul><!-- Main Navigation End -->
		</div><!-- Userbar End -->

		<div id="errorDiv" hidden="true">
        <div class='error grid_12'><h3 id="errorLabel"></h3><a class='hide_btn'>&nbsp;</a></div>
        </div>
        
        <?php
		if(isset($_GET['flag']))
		{
			if($_GET['flag'] == "1")
			{
				echo "<div class='success grid_12'><h3>Designation changed successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "2")
			{
				echo "<div class='error grid_12'><h3>Please select a designation</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "3")
			{
				echo "<div class='error grid_12'><h3>Fields cannot be empty</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "4")
			{
				echo "<div class='error grid_12'><h3>Current password is incorrect</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "5")
			{
				echo "<div class='error grid_12'><h3>New Passwords do not match</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "6")
			{
				echo "<div class='success grid_12'><h3>Password changed</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "7")
			{
				echo "<div class='success grid_12'><h3>Employee ID changed</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			elseif($_GET['flag'] == "8")
			{
				echo "<div class='success grid_12'><h3>Avatar changed</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			
		}//end of if
		?>
        
		<div class="clear"></div>
		<div id="body">
            
             <div class="block small"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Change Password</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                
                <form class="form" name="updatePasswordForm" action="updatePassword.php" method="post" onSubmit="return validateUpdatePassword()">
					<div class="form_row"><label>Current Password:</label><input class="input" type="password" style="width: 250px;" name="currentPassword" id="currentPassword" placeholder="Enter Current Password" original-title="Enter Current Password" /></div>
                    
                    <div class="form_row"><label>New Password:</label><input class="input" type="password" style="width: 250px;" name="newPassword" id="newPassword" placeholder="Enter New Password" original-title="Enter New Password" /></div>
                    
                    <div class="form_row"><label>Confirm New Password:</label><input class="input" type="password" style="width: 250px;" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password" original-title="Confirm New Password" /></div>
                        
                    <div class="form_row">
                        <input type="submit" class="submit" value="Update" />
                    </div>
				</form>
				</div>
			</div><!-- Block End -->
            
            <div class="block small"><!-- Change Employee ID: Block Begin -->
				<div class="titlebar">
					<h3>Change Employee ID</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                
                <div class="form_row">Current Employee ID: 
                <?php
					include("mysqlConnect.php");
					
					$query = "SELECT EmployeeID from employeeinfo WHERE EID = '$userID'";
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    $num_results = mysql_num_rows($result);	
                    $row = mysql_fetch_array($result);
					echo "<b>" . $row['EmployeeID'] . "</b>";
					
					mysql_close($db);
                ?>
                </div><br/>
                
                <form class="form" name="updateEmployeeID" action="updateEmployeeID.php" method="post" onSubmit="return validateUpdateEmployeeID()">
					<div class="form_row"><label>New Employee ID:</label><input class="input" type="input" style="width: 250px;" name="newEmployeeID" id="newEmployeeID" placeholder="Enter new Employee ID" original-title="Enter new Employee ID" /></div>
                    <div class="form_row">
                        <input type="submit" class="submit" value="Update" />
                    </div>
				</form>
				</div>
			</div><!-- Block End -->
            
            <div class="block small"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Change Avatar</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                
                <form class="form" name="updateAvatar" action="updateAvatar.php" method="post" onSubmit="return validateAvatarURL()">
					<div class="form_row"><label>Image URL:</label><input class="input" type="input" style="width: 250px;" name="newURL" id="newURL" placeholder="Enter the image URL" original-title="Enter the image URL" /></div>
                    <div class="form_row">
                        <input type="submit" class="submit" value="Change" />
                    </div>
				</form>
				</div>
			</div><!-- Block End -->
            
		</div><!-- Body Wrapper End -->
	
</body>
</html>