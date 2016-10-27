<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	$ativechk = 6;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Device Police</title>

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
                Page for Device Police
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="homepage.php">Dashboard</a>
                </li>
                <li class="active"> Device Record for Police </li>
            </ul>
        </div>
        
         
       
     
        
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
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
            <th>Owner</th>
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
							 echo "<td style=\"vertical-align:middle;\"><a href=\"device_detail.php?deviceid=" . $row['DeviceID'] . 
										"\" class=\"btn btn-success btn-xs btn-block\" type=\"button\"><i class=\"fa fa-android\"></i> " . $row['DeviceName'] . "</a></td>";
							}
							
							if ( $row['OSType'] == 'iOS')
							{
							 echo "<td style=\"vertical-align:middle;\"><a href=\"device_detail.php?deviceid=" . $row['DeviceID'] . 
										"\" class=\"btn btn-primary btn-xs btn-block\" type=\"button\"><i class=\"fa fa-apple\"></i> " . $row['DeviceName'] . "</a></td>";
							}
								
							
							
							 echo "<td style=\"vertical-align:middle;\">"; 
							  if ($row['OwnedBy'] == 'Charging')
							 {
							 	echo "<button class=\"btn btn-info btn-xs btn-block\" type=\"button\"><i class=\"fa fa-flash\"></i> Charging</button></td>";
							 }
							 else if ($row['OwnedBy'] == '')
							 {
								 echo "</td>";
							 }
							 else
							 {
							 	echo "<button class=\"btn btn-warning btn-xs btn-block\" type=\"button\"><i class=\"fa fa-user\"></i> ".$row['OwnedBy'] . "</button></td>";
							 }
							
							 
							 
							
								
								
							 
							 
							 	echo "</td>";
								
							 
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
<script src="js/dynamic_table_init2.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>
