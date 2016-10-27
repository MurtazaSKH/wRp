<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	
	$DeviceId = $_GET['deviceid'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT * FROM devicelist WHERE DeviceID =  '$DeviceId'";
			
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row2 = mysql_fetch_array($result);
	$timestamp = strtotime($row2[7]);
							 
	$names = "None";
							 
	if ($row2[6] != "")
	$names = $row2[6];
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
<title><?php echo $row2[8]; ?> Info </title>

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
    
    <!-- header section start-->
    <div class="header-section"> 
      
      <!--toggle button start--> 
      <a class="toggle-btn"><i class="fa fa-bars"></i></a> 
      <!--toggle button end--> 
      
      <!--notification menu start -->
      <div class="menu-right">
        <ul class="notification-menu">
          <li> <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo $avatarPath; ?>" alt="" /> <?php echo $userName ?> <span class="caret"></span> </a>
            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
              <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
              <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--notification menu end --> 
      
    </div>
    <!-- header section end--> 
    
    <!-- page heading start-->
    <div class="page-heading">
      <h3><?php echo $row2[8]; ?> Info </h3>
      <ul class="breadcrumb">
        <li> <a href="homepage.php">Dashboard</a> </li>
        <li> <a href="device_rc.php">Device Record</a> </li>
        <li class="active"><?php echo $row2[5]; ?> Info </li>
      </ul>
    </div>
    <!-- page heading end--> 
    
    <!--body wrapper start-->
    <div class="wrapper">
      <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading">Checkout History<span class="tools pull-right"> <a href="javascript:;" class="fa fa-chevron-down"></a></span> </header>
            <div class="panel-body">
              <div class="adv-table">
                <table  class="display table table-bordered table-striped" >
                  <thead>
                    <tr>
                      <th><center>Name</center></th>
                      <th><center>Checkout Time</center></th>
                      <th><center>Checkin Time</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php 
							
							$query = "SELECT * FROM checkoutlog WHERE DeviceName =  '$row2[8]' ORDER BY  `checkoutlog`.`DateOwned` DESC LIMIT 0 , 30";		
							$result = mysql_query($query) or die('Query failed: ' . mysql_error());
							$num_results = mysql_num_rows($result);	
							$row = NULL;
							
							
						if ($num_results == 0)
						{
						echo" <a href=\"#\" 
							 class=\"btn btn-large btn-block btn-primary\"><strong class=\"uppercase\">No Device Checked Out</strong></a>   ";						
						}
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							 $timestamp = strtotime($row['DateOwned']);
							 $timestamp2 = strtotime($row['checkedin']);
	
							
							echo "<tr class=\"gradeX\"><td><center>".$row['OwnedBy']."</center></td>
							<td><center>".date("g:i a", $timestamp)." - ".date("l, F d, Y", $timestamp)."</center></td>
							<td><center>".date("g:i a", $timestamp2)." - ".date("l, F d, Y", $timestamp2)."</center></td>";		
						}
 
							 ?>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th><center>Name</center></th>
                      <th><center>Checkout Time</center></th>
                      <th><center>Checkin Time</center></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!--body wrapper end--> 
    
    <!--footer section start-->
    <footer> 2014 &copy; weRplay Apps </footer>
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
