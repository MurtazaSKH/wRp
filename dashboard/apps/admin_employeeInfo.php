<?php
	include("sessionHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Employee Info</title>
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
            </div><!-- Profile End -->
            <ul id="navigation"><!-- Main Navigation Begin -->
                <li><a href="home.php" class="icon_home">Dashboard</a></li>
                <?php
                include("mysqlConnect.php");
                
                $query = "SELECT DsgID FROM operationrights WHERE AppName = 'DeviceRecords' AND RightName = 'Basic'";
                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                $num_results = mysql_num_rows($result);
                $row = NULL;
                $deviceRecordsDsg[0]=0;	//Hold the Designation IDs of Device Records app authorized designations
                                        
                for($i=0; $i < $num_results ; $i++)
                {
                     $row = mysql_fetch_array($result);
                     $deviceRecordsDsg[$i] = $row['DsgID'];
                     
					 //Check if user holds access to Device Records app
                     if($dsgID == $deviceRecordsDsg[$i])
                     {
                         echo "<li><a href='drec_home.php' class='icon_pictures'>Device Records</a></li>";
                         break;
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
                ?>
                
                <li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
            </ul><!-- Main Navigation End -->
        <div class="clear"></div>
		<div id="body">
        	<div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Personal Detail</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<?php
						$employeeID = $_GET['eid'];
						
						$query = "SELECT * FROM employeeinfo WHERE EID = '$employeeID'";
		                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$row = mysql_fetch_array($result);
						
						echo "<p><img src=".$row['AvatarPath']." alt='Avatar' height='44' width='44' /></p>";
						echo "<p><strong>Employee ID: </strong>". $row['EmployeeID']. "</p>";
						echo "<p><strong>Name: </strong>". $row['Name']. "</p>";
						echo "<p><strong>Official Email: </strong>". $row['Email']. "</p>";
						echo "<p><strong>Next of Kin Name: </strong>". $row['KinName']. "</p>";
						echo "<p><strong>Next of Kind Contact Number: </strong>". $row['KinContact']. "</p>";
						echo "<p><strong>Bank Account Number: </strong>". $row['AccountNumber']. "</p>";
						echo "<p><strong>Date of Birth: </strong>". $row['DateofBirth']. "</p>";
						echo "<p><strong>CNIC: </strong>". $row['CNIC']. "</p>";
						echo "<p><strong>Contact Number: </strong>". $row['ContactNumber']. "</p>";
						echo "<p><strong>Residential Address: </strong>". $row['Address']. "</p>";
						echo "<p><strong>Personal Email: </strong>". $row['PersonalEmail']. "</p>";
						
						mysql_close($db);
					?>
				</div><!--End of block_count-->
			</div><!-- Block End of block big-->
		</div><!--Body End-->

	</div><!-- Body Wrapper End -->
	
</body>
</html>