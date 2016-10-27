<?php
	include("sessionHeader.php");
	$title=$_GET['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><? echo "Output: ".$title; ?></title>
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
<script type="text/javascript" src="lmcbutton.js"></script>
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




function DemoAlert()
 {
   alert('Hi, Lazy people your ticket has been copied :D');
 }
 


</script>
<style>
textarea#ticket {
	width: 600px;
	border: 5px solid #CCC; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 15px;
	font-size:14px;
	font-family: Tahoma, sans-serif;
	background-image: url(bg.gif);
	background-position: bottom right;
	background-repeat: no-repeat;
}
input {
	width:600px;
    border: 5px solid #CCC; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 15px;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
	font-size:15px;
	font-family: Tahoma, sans-serif;
}
</style>


</head>


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
				
				
				
				
				?>
                
				<li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
			</ul><!-- Main Navigation End -->
		</div><!-- Userbar End -->

		<div id="errorDiv" hidden="true">
        <div class='error grid_12'><h3 id="errorLabel"></h3><a class='hide_btn'>&nbsp;</a></div>
        </div>
        
     
        
		<div class="clear"></div>
		<div id="body">
			<div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Generated Ouput</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>

                            
				<div class="block_cont">
				Note: If you want to save the ticket you can bookmark the output link it can be edited later.
                <br>
                <br>
           
<?php 

    
			

$occurrence=$_GET['occurrence'];
$note=$_GET['note'];
$crash=$_GET['crash'];
$build=$_GET['build'];
$dcon=$_GET['dcon'];
$device=$_GET['device'];
$counterresult=$_GET['counterresult'];
$counterstep=$_GET['counterstep'];
$os=$_GET['os'];
$ios = $_GET['ios'];
$category = $_GET['category'];
$time = $_GET['time'];
$andid = $_GET['andid'];
$gid = $_GET['gid'];
$crtime = $_GET['demo1'];
$recoverable = $_GET['recoverable'];
$reference=$_GET['reference'];

 $url = $_SERVER['QUERY_STRING'];

	$query = "INSERT INTO ticketlist(username, title, ticket) VALUES ('$userName', '$title', '$url')";
	mysql_query($query) or die('Query failed: ' . mysql_error());


include("mysqlConnect.php");
				
				
			$device2 =	str_replace('weRplay ', '', $device);
				
			$query = "SELECT OSVersion FROM devicelist where DeviceName ='$device2'";
				
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
			$os = mysql_fetch_row($result);
			
			
			if ($andid)
			{
				$query = "SELECT DIDs FROM devicelist where DeviceName ='$device2'";
				
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
				$andid2 = mysql_fetch_row($result);
			
			}
			

function newcheck ($check)
{
	
      return str_replace('\\', '', $check);
}

echo "<input type=\"text\" name=\"title\" id=\"title\" value=\"".newcheck ($title)."\" width=\" 180px\"  >"; ?>
&nbsp;&nbsp;<script type="text/javascript"> ShowLMCButton(document.getElementById("title").value, '', 'DemoAlert()');  </script>
<?
 echo "<br><br>";
$heighttext = 10+$counterresult + $counterstep;

if ($crash)
 	$heighttext++;

if ($ios)
 	$heighttext++;

if ($note)
	$heighttext++;

if ($andid)
	$heighttext++;

if ($gid)
	$heighttext++;
	
if ($time)
	$heighttext++;

if ($category)
	$heighttext++;
	
if ($crtime)
	$heighttext++;



echo "<textarea class=\"input\" name=\"ticket\" id=\"ticket\" rows=\"".$heighttext."\" cols=\"50\" onfocus=\"setbg('#e5fff3');\" onblur=\"setbg('#e5fff3')\">";

for  ($i = 1; $i < $counterstep+1; $i++)
{
       //$str = $_GET['step'][$i];
       //$str = str_replace('\\', '', $str);

	echo  $i.".&nbsp;".newcheck ($_GET['step'][$i]) .".&#10;";
	
	if ($_GET['observe'][$i])
	{	
		
		echo "&nbsp;&nbsp;-- Observe: &nbsp;".newcheck ($_GET['observe'][$i]).".&nbsp;(".$_GET['expected'][$i].")&#10;";
	}
}

for  ($j = 1; $j < $counterresult+1; $j++)
{
	echo  "&#10;&nbsp;&nbsp;-- Result: ".newcheck ($_GET['result'][$j]).".&#10;";	
}
if ($occurrence == 1)
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This only happened once.";
else if ($occurrence == 2)
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This happened 1/2 times.";
else if ($occurrence == 3)
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This happened 2/2 times.";
else if ($occurrence == 4)
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This happened 3/5 times.";
else 
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It happened randomly.";
	
if ($andid) {	
if ($recoverable == 1)
	echo "&#10;&#10;&nbsp;This issue is recoverable";
else if ($recoverable == 2)
	echo "&#10;&#10;&nbsp;This issue is irrecoverable";
else 
	echo "&#10;&#10;&nbsp;No Option choosen for recoverable field.";
}
	
if ($note)
	echo "&#10;&#10;&nbsp;Note: ".$note.".";
	
if ($ios)
 	echo "&#10;&#10;&nbsp;iOS: ".$ios;

if ($crash)
 	echo "&#10;&#10;&nbsp;Crash Report Link: ".$crash;
 	
if ($crtime)
	echo "&#10;&nbsp;Crash Time: ".$crtime;

if ($andid)
	echo "&#10;&nbsp;Andriod ID: ".$andid2[0]."";

if ($gid)
	echo "&#10;&nbsp;Gmail ID: ".$gid."";
	
if ($time)
	echo "&#10;&nbsp;Time: ".$time."";

if ($category)
	echo "&#10;&#10;&nbsp;Category: ".$category."";

echo "&#10;&#10;&nbsp;Reference: ".$reference;

echo ".&#10;&#10;Found on ".$build
	 ." using DCon ".$dcon
	 ." on ".$device
	 ." / ".$os[0].".";


?>

</textarea>
<script type="text/javascript"> ShowLMCButton(document.getElementById("ticket").value, '', 'DemoAlert()');  </script>
  <!--<input type="button" class="icon_save"  value="Save" >
                    <input type="button" class="icon_save"  value="Cancel" >-->
				</div>
			</div><!-- Block End -->
		</div>
	</div><!-- Body Wrapper End -->
</body>
</html>