<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Device Records</title>
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
<script class="code" type="text/javascript"><!-- Plugin Examples -->
$(document).ready(function(){
	$('.accordion').accordion();
	
	$('#mainpageTabs').tabs();
		
	$('#dialog').dialog({
		autoOpen: false,
		width: 600,
		modal: true,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	$('#openDialog').click(function(){
		$('#dialog').dialog('open');
		return false;
	});
	
	$('#dialog_link, ul.icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
});
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
					<img src="<?php echo $avatarPath; ?>" alt="Avatar" height="44" />
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
				<li class="activepage"><a href="#" class="icon_pictures">Device Records</a>
				<li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
			</ul><!-- Main Navigation End -->
		</div><!-- Userbar End -->
		<div class="clear"></div>
        <?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)//user checked out a device
				{
					echo "<div class='success grid_12'><h3>Success! You own the Device</h3><a class='hide_btn'>&nbsp;</a></div>";
				}//end of inner if
				elseif($_GET['flag'] == 2)// user cleared of all possessions
				{
					echo "<div class='success grid_12'><h3>You have been cleared of all possession</h3><a class='hide_btn'>&nbsp;</a></div>";
				}//end of if
				elseif($_GET['flag'] == 3)//Admin: Cleared all ownerships
				{
					echo "<div class='success grid_12'><h3>All Device Ownerships Cleared</h3><a class='hide_btn'>&nbsp;</a></div>";
				}//end of elseif
				elseif($_GET['flag'] == 4)//Admin: A single device cleared
				{
					echo "<div class='success grid_12'><h3>Success! Ownership Cleared</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
				elseif($_GET['flag'] == 5)//Device info updated
				{
					echo "<div class='success grid_12'><h3>Device Info Updated Successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
				elseif($_GET['flag'] == 6)//Device added
				{
					echo "<div class='success grid_12'><h3>New Device Added Successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
			}//end of outer if
		?>
		<div id="body">
			<div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Device Records</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<div class="table"><table><!-- Table Wrapper Begin -->
						<thead>
							<tr>
							<th>Device Name</th>
							<th>OS Version</th>
                            <th>Current Owner</th>
                            <th>Latest Update</th>
                            <?php
							include("mysqlConnect.php");
			
							$query = "SELECT DsgID FROM operationrights 
							WHERE RightName = 'Admin' AND AppName = 'DeviceRecords'";
							$result = mysql_query($query) or die('Query failed: ' . mysql_error());
							$num_results = mysql_num_rows($result);	
							$row = NULL;
							
							//check if current user is admin or lead
							for($i = 0; $i < $num_results ; $i++)
							{
								 $row = mysql_fetch_array($result);
								 $adminDsg[$i] = $row['DsgID'];
								 
								 if ($dsgID == $adminDsg[$i])
								 {
									 break;
								 }//end of if
							}	 
								 
									 echo "<th width='80' class='sorting_disabled'>Clear</th>";
								
							//}//end of for
							?>
							</tr>
						</thead>
                        <?php
						include("mysqlConnect.php");
			
						$query = "SELECT * FROM devicelist ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							 
							 
							 echo "<tr ";
							 
							 if ($row['OwnedBy'] == 'Charging')
							 {
							 	echo "style=\"color: red;\"";
							 }
							 
							 echo " >";
							 echo "<td>" . $row['DeviceName'] . "</td>";
							 echo "<td>" . $row['OSType'] . " " . $row['OSVersion'] . "</td>";
							 echo "<td>" . $row['OwnedBy'] . "</td>";
							 echo "<td>" . $row['LastUpdate'] . "</td>";
							 echo "<td><div style='height: 3px;'>&nbsp;</div>";
							 
							 for($j=0; $j< count($adminDsg) ; $j++)
							 {
							     if($dsgID == $adminDsg[$j])
								 {
								 
								 break ;
								 
								 }
								 
								 						
								 
							 }//end of for
							 
							 
							 if($dsgID == $adminDsg[$j])
								 {
									echo "<div class='actionbar'>
										 <a href='processCheckOut.php?flag=charge&did=". $row['DeviceID'] .
										 "' class='action edit'><span>Charge</span></a>
										<a href=\"devicerecord.php?deviceid=" . $row['DeviceID'] . 
										"\"class=\"action view\"><span>View</span></a>
										 <a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class='action delete'><span>Clear</span></a>
										</div>";
										
								 }//end of if
								
								 else
								 {
								 
								 	echo "<div class='actionbar'><a href=\"devicerecord.php?deviceid=" . $row['DeviceID'] . "\" 				 		class=\"action view\"><span>View</span></a>";
									
									if ( $row['OwnedBy'] != 'Charging' && $row['OwnedBy'] == $userName )
									{
										echo " <a href='processCheckOut.php?flag=charge&did=". $row['DeviceID'] .
										 "' class='action edit'><span>Charge</span></a>";
									} 
									if ( $row['OwnedBy'] == $userName || $row['OwnedBy'] == 'Charging' )
									{
										 echo "<a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class='action delete'><span>Clear</span></a>";
									}
									
									
										 echo "</div>";
										
								 
								 }	
							 
							 
							 	echo "</td>";
							 
							 echo "</tr>";
						}//end of for
						echo "</table>";
						echo "</div>";
						
						echo "<br/>  <br/>";
						
						mysql_close();
						?>
					</table></div><!-- Table Wrapper End -->
				</div>
                
                <div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Operations</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<div id="mainpageTabs">
						<ul>
							<li><a href="#tabs-1">Device Operations</a></li>
                            
                            <?php
                            for($j=0; $j< count($adminDsg) ; $j++)
							 {
								 if($dsgID == $adminDsg[$j])
								 {
									  echo "<li><a href='#tabs-2'>Admin Operations</a></li>";
									 break;
								 }//end of if
							 }//end of for
							?>
							
						</ul>
						<div id="tabs-1">
							<div class="navbutton_showcase"><!-- Button Icons Begin -->
								<a href="checkOut.php" class="navbutton"><span class="icon_right">Check Out Device</span></a>
								<a href="processCheckOut.php?flag=disown" class="navbutton"><span class="icon_minus">Clear Ownership</span></a>
							</div><!-- Button Icons End -->					
						</div>
                        
                        <?php
                            for($j=0; $j< count($adminDsg) ; $j++)
							 {
								 if($dsgID == $adminDsg[$j])
								 {
									 echo "<div id='tabs-2'>"
									 . "<div class='navbutton_showcase'>"
									 
									 . "<a href='alterRecords.php' class='navbutton'>
									 	<span class='icon_pen'>Alter Records</span></a>"
									
									 . "<a href='checkOutLog.php' class='navbutton'>
									 	<span class='icon_paste'>Check Out Log</span></a>"
									 . "</div>"//end of navbutton_showcase
									 
									 . "</div>";//end of tabs-2
									 
									 break;
								 }//end of if
							 }//end of for
						?>
						
					</div>
				</div>
			</div><!-- Block End -->
                
                
			</div><!-- Block End -->
		</div>
	</div><!-- Body Wrapper End -->    
</body>
</html>