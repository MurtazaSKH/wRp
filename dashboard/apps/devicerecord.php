<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	
	$DeviceId = $_GET['deviceid'];
	
	include("mysqlConnect.php");
	
	
			$query = "SELECT * FROM devicelist WHERE DeviceID =  '$DeviceId'";
			
			
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
						
							
							$row2 = mysql_fetch_array($result);
							
							 $timestamp = strtotime($row2[4]);
							 
							 $names = "None";
							 
							 if ($row2[3] != "")
							  $names = $row2[3];
							  
							  
							  
			
?>
<!DOCTYPE html>
<!--[if lt IE 9]>      <html lang="en" class="ie"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
	<!-- meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" >
	<meta name="keywords" content="spookynet.org, webdesignlab.org " /> 
	<!-- favicon -->
	<link rel="shortcut icon" href="img/favicon.png" type="image/png">
	
	<!-- page title -->
	<title><?php echo $row2[5]; ?> Info - weRplay Apps</title>
	
	<!-- css -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="css/bootstrap-responsive.css">
	<link type="text/css" rel="stylesheet" href="css/vendor/circle.hover.css">
    <link type="text/css" rel="stylesheet" href="css/vendor/jquery.mcustomscrollbar.css" >
	<link type="text/css" rel="stylesheet" href="css/main.css">
	<link type="text/css" rel="stylesheet" href="css/media.css">
	
	<!-- layout appearance -->
    <script src="js/vendor/jquery-1.9.0.min.js"></script>
	<script src="js/appearance.js"></script>

</head>
<body>
	
<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- gotop -->
		<div id="gotop"></div>
		
		<!-- top navigation bar -->
		<span class="accent-1"></span>
		
		<div class="navbar navbar-fixed-top">
		  
			<a href="dashboard.html">
				<div id="logo"></div>
			</a>

			
			
			
			
			<!-- right part header icons -->
			
			
			<!-- user sidebar -->
			<div id="user-settings" class="right-bar">
				<div class="side-wrap top-10 main">
					<ul class="top-5">
						<li>Username: <?php echo $userName ?></li>
						<li>Last login: 09.05.2013</li>
						<li>User permissions: <?php echo $dsgName ?></li>
					</ul>
					
					<span class="dotted"></span>
					
					
					
				</div>
			</div>
			
			
			
		 
		</div>
		
		
		<!-- sidebar -->
		<div class="sidebar-nav">
			
			<div id="user-box">
				<em>Hola!</em><br />
				<em><?php 
				$arr = explode(' ',trim($userName ));
				echo $arr[0];
				
				 ?></em>
			</div>
			
			<a class="prof-pic right-open" href="javascript:;" data-href="#user-settings">
				<img src="<?php echo $avatarPath; ?>" width="74" height="70" alt="">
			</a>
			
			<!-- sidebar navigation -->
			<ul id="navigation">
				<li><a class="active" href="homepage.php"><i class="nav-dashboard"></i>Dashboard</a></li>
				
				
				<li>
						<a href="index.php?flag=kill"><i class="nav-chart"></i>Log-Out</a>
					
				</li>
				
			</ul>
		</div>
		

		<div class="container">
			
			<div class="page-top">
				<div id="title">
					<?php echo $row2[5]; ?> Info
				</div>
				<div id="breadcrumb">
					<div class="config">
					</div>
					<ul>
						<li><a class="home" href="homepage.php">&nbsp;</a></li>
						<li><a href="drec_home.php">Device Record</a></li>
					</ul>
				</div>
			</div>
			
			
			
			
			<div id="content">
			
			
			
			
							<div class="toggle-content">
								<div class="whead">
									<strong>General Device Info</strong>
								</div>
								
								<div class="box holder">
									<p class="padd-15"><span <?php echo "<span style=\"line-height:30px !important;\"> <class=\"blackbg\">$row2[5]</span> have ADID or UDID as <span class=\"blueBg\">".$row2[6]."</span> and <span class=\"greenBg\">$row2[1] version $row2[2]</span>.<br> This device is currently owned by <span class=\"redBg\">$names</span> and was last checked out at  <span class=\"grayLightBg\">".date("H:i:s", $timestamp)."</span> on  <span class=\"grayLightBg\">".date("l, F d, Y", $timestamp)."</span>."; ?></span></p>
								</div>
							</div>
			
			
			
			
					<div class="whead top-10">
						<strong>Device History</strong>
					</div>
					
					<!-- table search input -->
					<div class="table-search-holder sizing">
						<input type="text" class="table-search" placeholder="Search for a row...">
					</div>
					
					<?php   
					
					
					
							
							$query = "SELECT * FROM checkoutlog WHERE DeviceName =  '$row2[5]' ORDER BY  `checkoutlog`.`DateOwned` DESC LIMIT 0 , 30";
							
							  ?>
						
					<div class="box holder tblr twhite">
						<table>
							<thead>
								<tr>
									<th>Name</th><th>Checked Out</th><th>Checked In</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							
							
							$result = mysql_query($query) or die('Query failed: ' . mysql_error());
							$num_results = mysql_num_rows($result);	
							$row = NULL;
							
							
						if ($num_results == 0)
						{
						echo"    <a href=\"#\" 
							 class=\"btn btn-large btn-block btn-primary\"><strong class=\"uppercase\">No Device Checked Out</strong></a>   ";						
												}
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							 $timestamp = strtotime($row['DateOwned']);
							 $timestamp2 = strtotime($row['checkedin']);
	
							
							echo "<tr><td><center>".$row['OwnedBy']."</center></td><td><center>".date("H:i:s", $timestamp)." Hrs - ".date("l, F d, Y", $timestamp)."</center></td><td><center>".date("H:i:s", $timestamp2)." Hrs - ".date("l, F d, Y", $timestamp2)."</center></td></tr> ";
									
						}
 
							 ?>
							
						
							</tbody>
						</table>
					</div>
			
			
			
			
			
	
     
					
        
        </div>
			
			</div>
		</div> <!-- /container -->
		
        
        <script src="js/vendor/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/tweenLite/TweenMax.min.js"></script>
        <script src="js/vendor/prettify.js"></script>
        <script src="js/vendor/jquery.sparkline.min.js"></script>
        <script src="js/vendor/beautiful-data.min.js"></script>
        <script src="js/vendor/jquery.mcustomscrollbar.concat.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/page/tables_dynamic.js"></script>
	
</body>
</html>