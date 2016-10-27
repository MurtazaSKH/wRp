<?php
	include("sessionHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Employee Records</title>
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
	employeeName = document.forms["updateDesignationForm"]["employeeName"].value;
	deptName = document.forms["updateDesignationForm"]["departmentName"].value;
	dsgName = document.forms["updateDesignationForm"]["dsgList"].value;
	
	if(employeeName == 0)
	{
		document.getElementById("errorDiv").hidden = false;
		document.getElementById("errorLabel").innerHTML = "Please select an employee";

		return false;
	}
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
				
				$query = "SELECT DsgID FROM operationrights WHERE AppName = 'NotApplicable' AND RightName = 'Admin'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$num_results = mysql_num_rows($result);
				
				for($i=0; $i < $num_results ; $i++)
				{
					 $row = mysql_fetch_array($result);
					 					 
					 if($dsgID == $row['DsgID'])
					 {
						?>
                        <li class="activepage"><a href='admin_employeeOperations.php' class='icon_users'>Employee Info</a></li>
                        <?php
						 break;
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
				echo "<div class='error grid_12'><h3>Plese select an employee</h3><a class='hide_btn'>&nbsp;</a></div>";
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
			
		}//end of if
		?>
        
		<div class="clear"></div>
		<div id="body">
			
            <div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Employee Designations</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<table class="data-table"><!-- Table Wrapper Begin -->
						<thead>
							<tr>
                            <th>Avatar</th>
							<th>Name</th>
							<th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th width="80">Action</th>
                            
							</tr>
						</thead>
						
                        <?php
						include("mysqlConnect.php");
						
						$query = "SELECT EID, EmployeeID, Name, Email, AvatarPath FROM employeeinfo";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
						
						for($i = $num_results; $i > 0 ; $i--)
						{
							$row = mysql_fetch_array($result);
							$employeeID = $row['EID'];//employee ID of the employee to echo
							
							//designation ID of the employee to echo
							$query = "SELECT DsgID FROM employeedesignation WHERE EID = '$employeeID'";
							$resultDesgQuery = mysql_query($query) or die('Query failed: ' . mysql_error());
							$resultDesgRow = mysql_fetch_array($resultDesgQuery);
							$resultDesgID = $resultDesgRow['DsgID'];
							
							//designation name and department ID of the employee to echo
							$query = "SELECT DeptID, DsgName FROM designations WHERE DsgID = '$resultDesgID'";
							$resultDesgQuery = mysql_query($query) or die('Query failed: ' . mysql_error());
							$resultDesgRow = mysql_fetch_array($resultDesgQuery);
							$resultDesgName = $resultDesgRow['DsgName'];
							$resultDeptID = $resultDesgRow['DeptID'];
							
							//depratment name of the employee to echo
							$query = "SELECT DeptName FROM departments WHERE DeptID = '$resultDeptID'";
							$resultDeptQuery = mysql_query($query) or die('Query failed: ' . mysql_error());
							$resultDeptRow = mysql_fetch_array($resultDeptQuery);
							$resultDeptName = $resultDeptRow['DeptName'];
							
							//account status of the employee to echo
							$query = "SELECT Active FROM accountactive WHERE EID = '$employeeID'";
							$resultAccStatusQuery = mysql_query($query) or die('Query failed: ' . mysql_error());
							$resultAccStatusRow = mysql_fetch_array($resultAccStatusQuery);
							$resultAccStatusNumber = $resultAccStatusRow['Active'];
							$accountStatus = NULL;
							if ($resultAccStatusNumber == 0)
							{
								$accountStatus = "Inactive";
							}
							elseif ($resultAccStatusNumber == 1)
							{
								$accountStatus = "Active";
							}
							else
							{
								$accountStatus = "N/A";
							}
							
							$avatarPath = $row['AvatarPath'];
							
							echo "<tr>";
							echo "<td>" . "<img src='$avatarPath' alt='Avatar' width='44' height='44' />" . "</td>";
							echo "<td>" . $row['Name'] . "</td>";
							echo "<td>" . $row['Email'] . "</td>";
							echo "<td>" . $resultDeptName . "</td>";
							echo "<td>" . $resultDesgName . "</td>";
							echo '<td><div style="height: 3px;">&nbsp;</div>
							<div class="actionbar"><a href="admin_employeeInfo.php?eid='.$employeeID.'" class="action view"><span>View</span></a></div></td>';
							echo "</tr>";
						}//end of for
						
						mysql_close();
						?>
                        
					</table><!-- Table Wrapper End -->
				</div>
			</div><!-- Block End -->
            
            <div class="block small"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Change Designation</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                
                <form class="form" name="updateDesignationForm" action="updateDesignation.php" method="post" onSubmit="return validateUpdateDesignation()">
				<?php
                    include("mysqlConnect.php");
					
					$query = "SELECT EID, Name FROM employeeinfo";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    $num_results = mysql_num_rows($result);	
                    
					echo "<label>Employee</label>";
                    echo "<select class='select' style='width: 250px;' id='employeeName' name='employeeName' onChange='getDesignationList(this)'>";
                    echo "<option value='0'>" . "None" . "</option>";
                    for($i = 1; $i <= $num_results ; $i++)
                    {
                         $row = mysql_fetch_array($result);
                         echo "<option value='" . $row['EID'] . "'>" . $row['Name'] . "</option>";
                    }//end of for
                    echo "</select><br/>";
					
                    $query = "SELECT DeptID, DeptName FROM departments";
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    $num_results = mysql_num_rows($result);	
                    $row = NULL;
                    
                    echo "<label>Department</label>";
                    echo "<select class='select' style='width: 250px;' id='departmentName' name='departmentName' onChange='getDesignationList(this)'>";
                    echo "<option value='0'>" . "None" . "</option>";
                    for($i = $num_results; $i > 0 ; $i--)
                    {
                         $row = mysql_fetch_array($result);
                         echo "<option value='" . $row['DeptID'] . "'>" . $row['DeptName'] . "</option>";
                    }//end of for
                    echo "</select><br/>";
                    
                    mysql_close($db);
                ?>  
                    <div class="form_row">
                        <label>Designation:</label>
                        <select style="width: 250px;" name="dsgList" id="dsgList" disabled="true">
                            <option value="0">None</option>
                        </select>
                    </div>
                        
                    <div class="form_row">
                        <input type="submit" class="submit" value="Update" />
                    </div>
				</form>
				</div>
			</div><!-- Block End -->
            
		</div><!-- Body Wrapper End -->
	
</body>
</html>