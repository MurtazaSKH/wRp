<?php
	include("sessionHeader.php");
	$version = $_GET['ver'];
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Ticket</title>
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
<script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
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

function checkURL(url)
{
    return(url.match(/\.(jpeg|jpg|gif|png|JPEG|JPG|GIF|PNG)$/) != null);
}
var counterstep = 0;
 var counterresult = 0;

function removefieldstep (nodes )
{

	nodes.parentNode.removeChild(nodes);

	counterstep --;
	 $('#counterstep').val(counterstep);
	
}

function removefieldobserve (nodes )
{
	nodes.parentNode.parentNode.removeChild(nodes); 
}


function removefieldresult (nodes )
{
	nodes.parentNode.removeChild(nodes);
	counterresult --;
	 $('#counterresult').val(counterresult);
}


$(document).ready(function(){
 

  $("#btn1").click(function(){
counterstep ++;    
	 $("#f1").append("<div class=\"form_row\">Step "+ counterstep +": <input class='input validate[required] tipRight' type='text' style='width: 290px;' name='step["+counterstep+"]' id='step"+counterstep+"' placeholder='Enter Step'  />&nbsp;&nbsp;<a style=\"cursor:pointer;color:Red;\" onclick=\"removefieldstep (this.parentNode);\">Remove Step</a></div>"); 
	  $('#counterstep').val(counterstep);  

  });
  
  
  $("#btn2").click(function(){

	
	 $("#f1").append(" <br><div class=\"form_row\">Observe: <input class='input validate[required] tipRight' type='text' style='width: 290px;' name='observe["+counterstep+"]' id='observe"+counterstep+"' placeholder='Enter what you obsrved'  /><span class=\"form_row radioui\"> <input type=\"radio\" id=\"expected"+counterstep+1+"\"  name=\"expected["+counterstep+"]\" value=\"Expected\" checked><label for=\"expected"+counterstep+1+"\">Expected</label><input type=\"radio\" id=\"expected"+counterstep+2+"\" name=\"expected["+counterstep+"]\" value=\"Un-Expected\"><label for=\"expected"+counterstep+2+"\">Un-expected</label></span> &nbsp;&nbsp;<a style=\"cursor:pointer;color:Red;\" onclick=\"removefieldobserve (this.parentNode);\">Remove Observe</a></div> <br> <br>");  
	

  });
  
  
  $("#btn3").click(function(){
counterresult ++;
	 $("#f1").append("  <br><br><div class=\"form_row\">Result "+ counterresult +": <input class='input validate[required] tipRight' type='text' style='width: 290px;' name='result["+counterresult +"]' id='result"+counterresult+"' placeholder='Enter Result'  />&nbsp;&nbsp;<a style=\"cursor:pointer;color:Red;\" onclick=\"removefieldresult (this.parentNode);\">Remove Result</a></div><br><br><br>");     $("#counterresult").val(counterresult);

  });
  
  
 
});


function f2_onsubmit()
{
  

    $('#f1 :input').not(':submit').clone().hide().appendTo('#f2');
  
}




</script>

<style>
textarea#note {
	width:400px !important;
	height:100px !important;
}

select#occurrence {
	width:10px !important;
	
}

</style>

</head>
<body>
<?php
	$rss = new DOMDocument();
	$rss->load('https://ifarm.unfuddle.com/projects/19/messages.rss?aak=4beb28de1794dd602e52de98a2143b3f&pak=f95650226ccf3b9069c03b89ba0699ac');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$limit = 50;
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		////echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		//echo '<small><em>Posted on '.$date.'</em></small></p>';
		//echo '<p>'.$description.'</p>';
	}
?>


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
				
				$query = "SELECT Email FROM employeeinfo where EID = '$userID'";
				
				
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
				$email = mysql_fetch_row($result);
				
				
				?>
                
                		<script >
				
				$(document).ready(function(){
				
				$('#gid').val("<?php echo $email[0]; ?>"); 
				
				});
				</script>
                
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
					<h3>Form</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>

                            
				<div class="block_cont">
                                
                
					<form name="f1" id ="f1" class="form" action="" method="GET">
						<div class="form_row"><label>Title:</label><input class="input validate[required] tipRight" type="text" style="width: 500px;" name="title" id="title" placeholder="Enter title" original-title="Enter Title" /></div>
                        
                       


                        
						
						
			<br>
					 <div class="form_row"><button id='btn1'>New Step</button>&nbsp;<button id='btn2'>New Observe</button>&nbsp;<button id='btn3'>New Result</button></div>
                      <font color="#CCCCCC">-----------------------------------------------------------------------------------------------------------------------</font><br><br>
                     
					</form>
                
                    <br><font color="#CCCCCC">-----------------------------------------------------------------------------------------------------------------------</font>
                    <form name="f2" id = "f2" class="form" action="output.php" method="GET" onsubmit="f2_onsubmit()" >
             <label> Occurrence: </label>
             <div class="form_row radioui">
             			<input type="radio" id="r1" name="occurrence" value="1"><label for="r1">This happened only once</label>
				<input type="radio" id="r2" name="occurrence" value="2"><label for="r2">1/2 Times</label>
				<input type="radio" id="r3" name="occurrence" value="3"><label for="r3">2/2 Times</label>
                            	<input type="radio" id="r4" name="occurrence" value="4"><label for="r4">3/5 Times</label>
						</div>
             
             <label> Note: </label>
                    	<textarea class="textarea validate[maxSize[500]] tipBot" name="note" id="note" cols="40" rows="10"></textarea>
                        <br>
                         <?php if ($version == "android")
					 { ?>
			<br>
			<div class="form_row radioui">
                        <label>Recoverable: </label>
                    		<input type="radio" id="r5" name="recoverable" value="1"><label for="r5">Recoverable</label>
				<input type="radio" id="r6" name="recoverable" value="2"><label for="r6">Not Recroverable</label>
			</div>
                   		 
					 
                        <br>
                        <label>iOS: </label>
                    	<textarea class="textarea validate[maxSize[500]] tipBot" name="ios" id="ios" cols="40" rows="5"></textarea>
                        <br>
                        <br><? } ?>
                        <label> Crash Report Link: </label>
                            
                    <input type="text" class="input" name="crash" style="width:400px;" >
                    <br>
                    <div class="form_row">
							<label>Reference:</label>
						  <input class="input" type="text" name="reference" id="reference" style="width:200px;">
						</div>
                    <?php if ($version == "android")
					 { ?>

                    
                    <br>
                    <label>Category:</label>
                    <select name="category" id="category" class="select">
                    	<option selected="selected" value=''>None</option>
                    	<option value="Temporary Black Screen">Temporary Black Screen</option>
                        <option value="Permenant Black Screen">Permenant Black Screen</option>
                        <option value="Temporary Freeze">Temporary Freeze</option>
                        <option value="Permenant Freeze">Permenant Freeze</option>
                    </select>   
                      <br>  <br>  
                    Freeze/Black Screen Time:
                    <input class="input" type="text" name="time" id="time" style="width:40px;" > Seconds
                       
                    <br><br>
                    Andriod ID: 
                    <input type="checkbox" name="andid" value="andid"><br>
                    
                    <br>
                    <label>Gmail ID: </label>
                    <input class="input" name="gid" id="gid" style="width:200px;" >
                    <br>
                    <label> Time of Crash: </label>
                    <input id="demo1" type="text" size="25" name="demo1" class="input">&nbsp;<a href="javascript:NewCal('demo1','ddmmmyyyy',true,12)"><img src="img/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a> <? } ?>
                    <br>
                    <label> Found On: </label>
                    <!--<select name="build" class="select" style="width: 300px;" >
                    	<option value="1"> Build </option>
                        </select> -->
                        <input type="text" name="build" class="input" placeholder="Build" style="width:250px;" >
                        
              <?php      
			  if ($version == "android") 
			  {   
                $query = "SELECT DeviceID, OSVersion, DeviceName FROM devicelist where OSType ='Android' ORDER BY DeviceName";
			  }
			else
			 {
			  $query = "SELECT DeviceID, OSVersion, DeviceName FROM devicelist where OSType ='iOS' ORDER BY DeviceName";
			 }
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
			
				
			$num_results = mysql_num_rows($result);
			$row2 = NULL;		
				?>
                        
                      <input type="text" name="dcon" class="input" placeholder='DCON' > 
                        <select name="device" id="device" class="select" style="width: 50px !important;" >
                        <option value="0" selected="selected" > Device </option>
                        <?php
                         for ($i = $num_results; $i > 0 ; $i--) {
                         $row2 = mysql_fetch_array($result);
							 ?>
                    	<option value="<? echo "weRplay ".$row2[2]; ?>"><? echo $row2[2]; ?></option>
                        <? 
		 }
		 mysql_close($db);
								?>
                        </select>
                       
                        <input type='hidden' name='counterresult' id='counterresult'  >                        
                       <!-- <input type='hidden' name='counterobserve' id='counterobserve'  > -->
                        <input type='hidden' name='counterstep' id='counterstep' value='' >
                       <!-- <input class='input' type='text' style='width: 70px;' name='os' id='os' placeholder='OS Version'  /> 	-->					<br><br>
                        <input type="submit" class="submit" value="Save & Generate Output" />
                 </form>
                 
                    <!--<input type="button" class="icon_save"  value="Save" >
                    <input type="button" class="icon_save"  value="Cancel" >-->
				</div>
			</div><!-- Block End -->
		</div>
	</div><!-- Body Wrapper End -->
</body>
</html>