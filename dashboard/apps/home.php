<?php
	include("sessionHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>
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
</head>
<body>

	<div id="main" class="container_12"><!-- Body Wrapper Begin -->
		<div id="header"><!-- Header Begin -->
			<div class="grid_3"><a href="home.php" id="logo" class="float_left">weRplay Apps</a></div>
			
		</div><!-- Header End -->
        
		<?php include("navigationBar.php"); ?>
		
        <div class="clear"></div>
		<div id="body">
			
            <div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Applications</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                	<?php
					for($i=0; $i < count($deviceRecordsDsg) ; $i++)
					{					 
						 if($dsgID == $deviceRecordsDsg[$i])
						 {
							 echo "<a href='drec_home.php' class='navbutton'><span class='icon_pictures'>Device Records</span></a>";
							 break;
						 }//end of if
					}//end of for
					?>
                    
                    <a href='tickets.php' class='navbutton'><span class='icon_article'>Ticket Template</span></a>
					
				</div>
			</div><!-- Block End -->
            
            <div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Operations</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
                	<div class="navbutton_showcase"><!-- Button Icons Begin -->
                	<a href='settings.php' class='navbutton'><span class='icon_settings'>Profile Settings</span></a>
                    </div>
				</div>
			</div><!-- Block End -->
            
            <?php
				include("mysqlConnect.php");
				
				$query = "SELECT DsgID FROM operationrights WHERE AppName = 'NotApplicable' AND RightName = 'Admin'";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				$num_results = mysql_num_rows($result);
				
				for($i=0; $i < $num_results ; $i++)
				{
					 $row = mysql_fetch_array($result);
					 					 
					 if($dsgID == $row['DsgID'])
					 {
						?>
                        
                        <div class="block big"><!-- Block Begin -->
                            <div class="titlebar">
                                <h3>Adminstrative Operations</h3>
                                <a href="#" class="toggle">&nbsp;</a>
                            </div>
                            <div class="block_cont">
                                <div class="navbutton_showcase"><!-- Button Icons Begin -->
                                <a href='admin_employeeOperations.php' class='navbutton'>
                                <span class='icon_users'>Employee Info</span></a>			
                                
                                <a href='admin_appRights.php' class='navbutton'>
                                <span class='icon_settings'>App Rights</span></a>
                                </div>
                                
                            </div>
                        </div><!-- Block End -->
                        <?php
						 break;
					 }//end of if
				}//end of for
				
				mysql_close($db);
			?>
	</div><!-- Body Wrapper End -->
	
</body>
</html>