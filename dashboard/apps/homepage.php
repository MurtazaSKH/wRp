<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
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
	<title>weRplay Apps</title>
	
	<!-- css -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
	<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" >
	<link href="css/vendor/circle.hover.css" rel="stylesheet" type="text/css" >
	<link href="css/vendor/fullcalendar.css" rel="stylesheet" type="text/css" >
	<link href="css/vendor/sourcerer.css" rel="stylesheet" type="text/css" >
    <link href="css/vendor/prettify.css" rel="stylesheet" type="text/css" >
    <link href="css/vendor/jquery.mcustomscrollbar.css" rel="stylesheet" type="text/css" >
    <link href="css/vendor/jquery.gritter.css" type="text/css" rel="stylesheet" >
	<link href="css/main.css" rel="stylesheet" type="text/css" >
	<link href="css/media.css" rel="stylesheet" type="text/css" >
	
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
					Devices Checked-out
				</div>
				<div id="breadcrumb">
					<div class="config">
						<ul>
							<li><a href="javascript:;"><span class="icon-align-justify"></span></a></li>
							<li><a href="processCheckOut.php?flag=disown&pager=3213"><span class="icon-trash"></span></a></li>
						</ul>
					</div>
					<ul>
						<li><a class="home" href="testt.php">&nbsp;</a></li>
						<li>Dashboard</li>
					</ul>
				</div>
			</div>
			
			<div id="content">
			
	<?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)//user checked out a device
				{
					
           echo "<div class=\"alert alert-info fade in\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		<strong>You now own the device</strong> 
                    
                   To clear ownership you can now tap on the button below.  
                
            </div>";
				}//end of inner if
				elseif($_GET['flag'] == 2)// user cleared of all possessions
				{
					
             echo "<div class=\"alert alert-success fade in\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		<strong>You have been cleared of all possession</strong>  
                   To check out device place device with QR Code reader on the QR at the back of the device.
            </div> ";
				}//end of if
				elseif($_GET['flag'] == 3)//Admin: Cleared all ownerships
				{
				
					 echo "<div class=\"alert alert-success fade in\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		<strong>All Cleared</strong>  
                   All Device ownership have been cleared.
            </div> ";	
				}//end of elseif
				elseif($_GET['flag'] == 4)//Admin: A single device cleared
				{
				 	echo "<div class=\"alert alert-success fade in\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		<strong>Your device ownership cleared</strong>  
                   Ownership Cleared for your device.
            </div> ";	
				 	
				}
				elseif($_GET['flag'] == 5)//Device info updated
				{
					echo "<div class=\"alert alert-success fade in\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		<strong>Logged in Successfully</strong>  
                   Now you can checkut device by QR Codes.
            </div> ";
				
					
				}
				elseif($_GET['flag'] == 6)//Device added
				{
					echo "<div class='success grid_12'><h3>New Device Added Successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
			}//end of outer if
		?>
        <div class="wrapper"> 
     <?php
//$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $url;
?>			   
        

        
        <script type="text/javascript">
 
//check if hash tag exists in the URL
if(window.location.hash) {
 
 //set the value as a variable, and remove the #
 var hash_value = window.location.hash.replace('#', '');
 urlv = '<?php echo $url ;?>';
 //show the value with an alert pop-up
 
 window.location.href = urlv+' - '+hash_value; 
 
}
</script>		
					<div class="whead top-10">
						<strong>Tap any Device to Checkin!</strong>
					</div>
        <div class="box holder padd">
        <?php
						include("mysqlConnect.php");
						
						//echo "hi";
						//$userName = "Hammad Ahmed";
			
						$query = "SELECT * FROM devicelist where OwnedBy = \"$userName\" ORDER BY OSType, DeviceName";
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
							 
							
							 echo"    <a href=\"processCheckOut.php?flag=disownid&pager=3213&did=". $row['DeviceID'] ."\" 
							 class=\"btn btn-large btn-block btn-primary\"><strong class=\"uppercase\">". $row['DeviceName'] ."</strong><br />
                    " . $row['OSType'] . " " . $row['OSVersion'] . " and Last updated on " . $row['LastUpdate'] . "</a>   ";
							 
							/*
							 
							 echo "<tr>";
							 echo "<td>" . $row['DeviceName'] . "</td>";
							 echo "<td>" . $row['OSType'] . " " . $row['OSVersion'] . "</td>";
							 echo "<td>" . $row['OwnedBy'] . "</td>";
							 echo "<td>" . $row['LastUpdate'] . "</td>";
							 
							 for($j=0; $j< count($adminDsg) ; $j++)
							 {
								 if($dsgID == $adminDsg[$j])
								 {
									  echo "<td><div style='height: 3px;'>&nbsp;</div><div class='actionbar'>
										 <a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class='action delete'><span>Clear</span></a></div></td>";
										 break;
								 }//end of if
							 }//end of for
							 
							 
							 echo "</tr>";*/
						}//end of for
						
						
						mysql_close();
						?>
        
        </div>
        </div>
			
			</div>
		</div> <!-- /container -->
		
        <script src="js/vendor/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/tweenLite/TweenMax.min.js"></script>
        <script src="js/vendor/jquery.sparkline.min.js"></script>
        <script src="js/vendor/prettify.js"></script>
        <script src="js/vendor/excanvas.min.js"></script>
        <script src="js/vendor/jquery.flot.js"></script>
        <script src="js/vendor/jquery.flot.resize.js"></script>
        <script src="js/vendor/fullcalendar.min.js"></script>
        <script src="js/vendor/beautiful-data.min.js"></script>
        <script src="js/vendor/ckeditor/ckeditor.js"></script>
        <script src="js/vendor/jquery.mcustomscrollbar.concat.min.js"></script>
        <script src="js/vendor/jquery.gritter.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/page/dashboard.js"></script>
	
	<!-- Counter -->
	<script type="text/javascript">
	<!--
	d=document;d.write('<a href="http://www.tyxo.bg/?146605" title="Tyxo.bg counter"><img width="1" height="1" border="0" alt="Tyxo.bg counter" src="'+location.protocol+'//cnt.tyxo.bg/146605?rnd='+Math.round(Math.random()*2147483647));
	d.write('&sp='+screen.width+'x'+screen.height+'&r='+escape(d.referrer)+'"></a>');
	//-->
	</script><noscript><a href="http://www.tyxo.bg/?146605" title="Tyxo.bg counter"><img src="http://cnt.tyxo.bg/146605" width="1" height="1" border="0" alt="Tyxo.bg counter" /></a></noscript>
	<!-- // Counter -->
	
</body>
</html>