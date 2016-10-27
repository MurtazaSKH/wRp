<?php
	include('sessionHeader.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Alter Records</title>
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
	$('#datepicker').datepicker();
	
	$('.checkboxui, .radioui').buttonset();
	
	$('#slider').slider({ values: [20,50], range: true });
	
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
				<li class="activepage"><a href="drec_home.php" class="icon_pictures">Device Records</a>
				<li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
			</ul><!-- Main Navigation End -->
		</div><!-- Userbar End -->
        <?php
		if(isset($_GET['flag']))
		{
			if($_GET['flag'] == 3)
			{
				echo "<div class='error grid_12'><h3>Fields cannot be empty</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
			if($_GET['flag'] == 4)
			{
				echo "<div class='error grid_12'><h3>This record already exists in the database</h3><a class='hide_btn'>&nbsp;</a></div>";
			}//end of inner if
	}//end of if
		?>
		<div id="body">
			<div class="block small"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Edit Device Detail</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<?php
					include("mysqlConnect.php");
		
					$query = "SELECT DeviceName FROM devicelist";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());
					$num_results = mysql_num_rows($result);	
					$row = NULL;
					
					mysql_close($db);
					?>
                    <form class='form' action='processEditDevice.php' method='post'>
                        <div class='form_row'>
                            Device Name: <select class='select' name='deviceName'>
                            <option>No Device</option>
        
                            <?php
                            for($i = $num_results; $i > 0 ; $i--)
                            {
                                 $row = mysql_fetch_array($result);
                                 echo "<option>" . $row['DeviceName'] . "</option>";
                            }//end of for
                            ?>
                            </select>
                        </div>
                        
                        <div class='form_row'>OS Type: <select class='select' name='osType'><option>iOS</option> <option>Android</option></select></div>
                        <div class='form_row'>OS Version: <input type='text' class='input' name='osVersion' /></div>
                        <div class='form_row'>UDID/AID: <input class="input" type='text' id='dids' name='dids' /></div>
                        <div class='form_row'><input class='submit' type='submit' name='editDevice' value='Update Details' /></div>
                    </form>
						
			</div>
		</div><!-- Block End -->
        
        <div class="block small"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Add New Device</h3>
					<a href="#" class="toggle">&nbsp;</a>
				</div>
				<div class="block_cont">
					<form class="form" action='processAddDevice.php' method='post'>
                    <div class='form_row'>Device Name: <input class="input" type='text' id='deviceName' name='deviceName' /></div><br/>
                    <div class='form_row'>OS Type: <select class="select" id='osType' name='osType'><option>iOS</option> <option>Android</option></select></div><br/>
                    <div class='form_row'>OS Version: <input class="input" type='text' id='osVersion' name='osVersion' /></div>
                    <div class='form_row'>UDID/AID: <input class="input" type='text' id='dids' name='dids' /></div>
                    <input class="submit" type='submit' value='Add Device' id='addDevice' name='addDevice' />
                    </form>
				</div>
			</div><!-- Block End -->
        
	</div><!-- Body Wrapper End -->    
</body>
</html>