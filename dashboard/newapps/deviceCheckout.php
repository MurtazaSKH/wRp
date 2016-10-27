<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	$ativechk = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Device Checkout</title>

  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="js/morris-chart/morris.css">

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    
<?php  include ("headernew.php");?>
        <!-- page heading start-->
        <div class="page-heading">
          <h3> Device Checkout </h3>
            <ul class="breadcrumb">
                <li> <a href="homepage.php">Dashboard</a> </li>
        		<li> <a href="device_rc.php">Device Record</a> </li>
                <li class="active"> Device Checkout </li>
            </ul>
            
        </div>
     
        
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
             <?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)//user checked out a device
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> You own the Device";
                    echo "</div>";
				}//end of inner if
				elseif($_GET['flag'] == 2)// user cleared of all possessions
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> You have been cleared of all possession";
                    echo "</div>";
				}//end of if
				elseif($_GET['flag'] == 3)//Admin: Cleared all ownerships
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> All Device Ownerships Cleared";
                    echo "</div>";
				}//end of elseif
				elseif($_GET['flag'] == 4)//Admin: A single device cleared
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> Ownership Cleared";
                    echo "</div>";
				}
				elseif($_GET['flag'] == 5)//Device info updated
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> Device Info Updated Successfully";
                    echo "</div>";
				}
				elseif($_GET['flag'] == 6)//Device added
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> New Device Added Successfully";
                    echo "</div>";
				}
				elseif($_GET['flag'] == 7)//Put on charging
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> Device is marked as \"Charging\"";
                    echo "</div>";
				}
				elseif($_GET['flag'] == 8)//Put on charging
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> You have successfully checkedout the device.";
                    echo "</div>";
				}
			}//end of outer if
		?>
            <div class="row">
              <div class="col-md-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Android Devices Available
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
                             </span>
                        </header>
                        <div class="panel-body">
                        
                          <?php
						
						include("mysqlConnect.php");
						$query = "SELECT * FROM devicelist where OwnedBy = \"\" AND OSType = 'Android' ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
						if ($num_results == 0)
						{
						echo"    <a href=\"#\" 
							 class=\"btn btn-success btn-lg btn-block\"><strong class=\"uppercase\">No Device Checked Out</strong></a>   ";						
												}
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 $timestamp = strtotime($row['LastUpdate']);
							

							 echo"    <a href=\"processCheckOut.php?flag=checkoutid&pager=32133&did=". $row['DeviceID'] ."\" 
							 class=\"btn btn-success btn-lg btn-block\" style=\"padding:15px 15px 15px 15px;\"><span style=\"text-transform: uppercase; font-weight: bold;\">". $row['DeviceName'] ."</span><br />
                   <span  style=\" font-size: 15px;\"> <i class=\"fa fa-android\"></i>  " . $row['OSVersion'] . "  &nbsp;&nbsp;&nbsp;&nbsp;   <i class=\"fa fa-flash\"></i> Charging Comming Soon</a>   ";
						
							
						}//end of for
						
						
						
						?>
                        
                        
                           
                            <div class="text-center" style="margin-top:15px;"><a href="device_rc.php">View all Devices</a></div>
                        </div>
                    </div>
                </div>
              
               <div class="col-md-6">
                    <div class="panel">
                        <header class="panel-heading">
                             iOS Devices Available
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
                             </span>
                        </header>
                        <div class="panel-body">
                        
                          <?php

			
						$query = "SELECT * FROM devicelist where OwnedBy = \"\" AND OSType = 'iOS' ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
						if ($num_results == 0)
						{
						echo"    <a href=\"#\" 
							 class=\"btn btn-success btn-lg btn-block\"><strong class=\"uppercase\">No Device Checked Out</strong></a>   ";						
												}
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 $timestamp = strtotime($row['LastUpdate']);
							
	
							 echo"    <a href=\"processCheckOut.php?flag=checkoutid&pager=32133&did=". $row['DeviceID'] ."\" 
							 class=\"btn btn-primary btn-lg btn-block\" style=\"padding:15px 15px 15px 15px;\"><span  style=\"text-transform: uppercase; font-weight: bold;\">".$row['DeviceName'] ."</span><br />
                   <span  style=\" font-size: 15px;\"> <i class=\"fa fa-apple\"></i>  " . $row['OSVersion'] . "  &nbsp;&nbsp;&nbsp;&nbsp;   <i class=\"fa fa-flash\"></i> Charging Comming Soon</a>   ";
						
							
						}//end of for
						
						
						
						?>
                        
                        
                           
                            <div class="text-center" style="margin-top:15px;"><a href="device_rc.php">View all Devices</a></div>
                        </div>
                    </div>
                </div> 
               
                
                
                
            </div>

            

            <div class="row">
                
                
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2014 &copy; weRplay Apps
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>


<!--common scripts for all pages-->
<script src="js/scripts.js"></script>




</body>
</html>
