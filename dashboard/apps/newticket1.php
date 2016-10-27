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
				
				<em><?php echo $userName ?></em>
			</div>
			
			<a class="prof-pic right-open" href="javascript:;" data-href="#user-settings">
				<img src="<?php echo $avatarPath; ?>" alt="">
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
	<form name="f1" id ="f1" class="form" action="" method="GET">
						<div class="form_row"><label>Title:</label><input class="input validate[required] tipRight" type="text" style="width: 500px;" name="title" id="title" placeholder="Enter title" original-title="Enter Title" /></div>
                        
                       


                        
						<div class="form_row">
							<label>Reference:</label>
						  <input class="input" type="text" name="reference" id="reference" style="width:200px;">
						</div>
						
			<br>
					 <div class="form_row"><button id='btn1'>New Step</button>&nbsp;<button id='btn2'>New Observe</button>&nbsp;<button id='btn3'>New Result</button></div>
                      <font color="#CCCCCC">-----------------------------------------------------------------------------------------------------------------------</font><br><br>
                     
					</form>
                
                    <br><font color="#CCCCCC">-----------------------------------------------------------------------------------------------------------------------</font>
                    <form name="f2" id = "f2" class="form" action="output.php" method="GET" onsubmit="f2_onsubmit()" >
             <label> Occurrence: </label>
             <div class="form_row radioui">
							<input type="radio" id="r1" name="occurrence" value="1"><label for="r1">1/2 Times</label>
							<input type="radio" id="r2" name="occurrence" value="2"><label for="r2">2/2 Times</label>
						</div>
             
             <label> Note: </label>
                    	<textarea class="textarea validate[maxSize[220]] tipBot" name="note" id="note" cols="40" rows="10"></textarea>
                        <br>
                         <?php if ($version == "andriod")
					 { ?>
                        <br>
                        <label>iOS: </label>
                    	<textarea class="textarea validate[maxSize[220]] tipBot" name="ios" id="ios" cols="40" rows="5"></textarea>
                        <br>
                        <br><? } ?>
                        <label> Crash Report Link: </label>
                            
                    <input type="text" class="input" name="crash" style="width:400px;" >
                    <br>
                    <?php if ($version == "andriod")
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
                       
                    <br>
                    <label>Andriod ID: </label>
                    <input class="input" name="andid" id="andid" style="width:200px;" >
                    <br>
                    <label>Gmail ID: </label>
                    <input class="input" name="gid" id="gid" style="width:200px;" >
                    <br>
                    <label> Time of Crash: </label>
                    <input id="demo1" type="text" size="25" class="input">&nbsp;<a href="javascript:NewCal('demo1','ddmmmyyyy',true,12)"><img src="img/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a> <? } ?>
                    <br>
                    <label> Found On: </label>
                    <!--<select name="build" class="select" style="width: 300px;" >
                    	<option value="1"> Build </option>
                        </select> -->
                        <input type="text" name="build" class="input" placeholder="Build" style="width:250px;" >
                        
              <?php   
			  include("mysqlConnect.php");   
			  if ($version == "andriod") 
			  {   
                $query = "SELECT DeviceID, OSVersion, DeviceName FROM devicelist where OSType ='Android'";
			  }
			else
			 {
			  $query = "SELECT DeviceID, OSVersion, DeviceName FROM devicelist where OSType ='iOS'";
			 }
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
			$row2 = mysql_fetch_array($result);
				
				
				?>
                        
                      <input type="text" name="dcon" class="input" placeholder='DCON' > 
                        <select name="device" id="device" class="select" style="width: 50px !important;" >
                        <option value="0" selected="selected" > Device </option>
                        <?php
                         while ($row2 = mysql_fetch_array($result, MYSQL_NUM)) {
							 ?>
                    	<option value="<? echo "weRplay ".$row2[2]; ?>"><? echo "weRplay ".$row2[2]; ?></option>
                        <? 
		 }
		 mysql_close($db);
								?>
                        </select>
                       
                        <input type='hidden' name='counterresult' id='counterresult'  >                        
                       <!-- <input type='hidden' name='counterobserve' id='counterobserve'  > -->
                        <input type='hidden' name='counterstep' id='counterstep' value='' >
                        <input class='input' type='text' style='width: 70px;' name='os' id='os' placeholder='OS Version'  /> 						<br><br>
                        <input type="submit" class="submit" value="Save & Generate Output" />
                 </form>
        
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