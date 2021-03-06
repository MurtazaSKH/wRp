<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	$ativechk = 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Device Record</title>

  <!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

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
        <div class="col-lg-6 page-heading">
            <h3>
                Device Record
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="homepage.php">Dashboard</a>
                </li>
                <li class="active"> Device Record </li>
            </ul>
        </div>
        
         
        <div class="col-lg-4" style="padding-top:16px; text-align:center; float:right;">
        <section class="panel">
       
        <div class="panel-body">
        <a class="btn btn-danger" href="processCheckOut.php?flag=disown"  style="margin-top:6px;><i class="fa fa-sign-in"></i> Clear Ownership from all the devices</a>
        <a class="btn btn-success" href="deviceCheckout.php" style="margin-top:6px;"><i class="fa fa-sign-out"></i> Checkout a Device </a>
        </div>
        </section>
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
				elseif($_GET['flag'] == 9)//Put on charging
				{
					echo "<div class=\"alert alert-success fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Success!</strong> You have successfully deleted the device.";
                    echo "</div>";
				}
			}//end of outer if
		?>
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
            Devices with Details
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table class="display table table-bordered" id="hidden-table-info">
        <thead>
        <tr>
            <th>Device Name</th>
            <th>OS Version</th>
            <th>Owner</th>
            <th style="display:none;">Last Update</th>
            <th style="display:none;">Actions</th>
            <th style="display:none;">IMEI</th>
            <th style="display:none;">DIDs</th>
            <th style="display:none;">Resolution</th>
            <th style="display:none;">Vendor</th>
            <th style="display:none;">Device Priority</th>
        </tr>
        </thead>
        <tbody>
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
		
						$query = "SELECT * FROM devicelist ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							 
							 
							 echo "<tr class=\"gradeX\"";
							 
							 if ($row['OwnedBy'] == 'Charging')
							 {
							 	echo "style=\"color: green;\"";
							 }
							 
							 echo " >";
							
							if ( $row['OSType'] == 'Android')
							{
							 echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-android\"></i> " . $row['DeviceName'] . "</td>";
							}
							
							if ( $row['OSType'] == 'iOS')
							{
							 echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-apple\"></i> " . $row['DeviceName'] . "</td>";
							}
								
							echo "<td style=\"vertical-align:middle;\"> " . $row['OSVersion'] . "</td>";
							
							 echo "<td style=\"vertical-align:middle;\">"; 
							  if ($row['OwnedBy'] == 'Charging')
							 {
							 	echo "<button class=\"btn btn-success btn-xs btn-block\" type=\"button\"><i class=\"fa fa-flash\"></i> Charging</button></td>";
							 }
							 else
							 {
							 	echo "<strong>".$row['OwnedBy'] . "</strong></td>";
							 }
							 $timestamp = strtotime($row['LastUpdate']);
							 echo "<td style=\"display:none;\">".date("g:i a", $timestamp)." - ".date("l, F d, Y", $timestamp)."</td>";
							 echo "<td class=\"center\" style=\"display:none;\"><div style='height: 3px;'>&nbsp;</div>";
							 
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
										<a href='editdevice.php?did=". $row['DeviceID'] .
										 "' class=\"btn btn-default\"><i class=\"fa fa-edit\"></i><span> Edit</span></a>
										  <a href='processCheckOut.php?flag=checkoutid&did=". $row['DeviceID'] .
										 "' class=\"btn btn-success\"><i class=\"fa fa-check-circle\"></i><span> Checkout</span></a>
										 <a href='processCheckOut.php?flag=charge&did=". $row['DeviceID'] .
										 "' class=\"btn btn-warning\"><i class=\"fa fa-flash\"></i><span> Put on Charge</span></a>
										<a href=\"device_detail.php?deviceid=" . $row['DeviceID'] . 
										"\" class=\"btn btn-info\"><i class=\"fa fa-book\"></i><span> View History</span></a>
										<a href=\"processCheckOut.php?flag=delete&deviceid=" . $row['DeviceID'] . 
										"\" class=\"btn btn-primary\"><i class=\"fa fa-exclamation-circle\"></i><span> Delete Device</span></a>
										 <a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i><span> Clear Ownership</span></a>
										</div>";
										
								 }//end of if
								
								 else
								 {
								 
								 	if ( $row['OwnedBy'] == '')
									{
										echo  "<div class='actionbar'>
										  <a href='processCheckOut.php?flag=checkoutid&did=". $row['DeviceID'] .
										 "' class=\"btn btn-success\"><i class=\"fa fa-check-circle\"></i><span> Checkout</span></a>";
									} 
									
									echo "<a href=\"device_detail.php?deviceid=" . $row['DeviceID'] . 
										"\" class=\"btn btn-info\"><i class=\"fa fa-book\"></i><span> View History</span></a>";
									
									if ( $row['OwnedBy'] != 'Charging' && $row['OwnedBy'] == $userName )
									{
										echo  "<a href='processCheckOut.php?flag=charge&did=". $row['DeviceID'] .
										 "' class=\"btn btn-warning\"><i class=\"fa fa-flash\"></i><span> Put on Charge</span></a>";
									} 
									if ( $row['OwnedBy'] == $userName || $row['OwnedBy'] == 'Charging' )
									{
										 echo "<a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i><span> Clear Ownership</span></a>";
									}
									
									
										 echo "</div>";

								 }	
							 
							 
							 	echo "</td>";
								echo "<td class=\"center\" style=\"display:none;\">" . $row['DIDs'] . "</td>";
								echo "<td class=\"center\" style=\"display:none;\">" . $row['EMEI'] . "</td>";
								echo "<td class=\"center\" style=\"display:none;\">" . $row['Resolution'] . "</td>";
								echo "<td class=\"center\" style=\"display:none;\">" . $row['Vendor'] . "</td>";
								echo "<td class=\"center\" style=\"display:none;\">" . $row['Priority'] . "</td>";
							 
							 echo "</tr>";
						}//end of for
						
						
						mysql_close();
						?>
       
       
        </tbody>
        </table>

        </div>
        </div>
        </section>
        </div>
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

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>