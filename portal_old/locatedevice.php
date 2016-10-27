<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	
	$DeviceId = $_GET['deviceid'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT * FROM devicelist WHERE DeviceID =  '$DeviceId'";
			
	$result = mysqli_query($db,$query) or die('Query failed: ' . mysqli_error($db));
	$row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
        <li class="active">Locate Device </li>
      </ul>
    </div>
    <!-- page heading end--> 
    
    <!--body wrapper start-->
    <div class="wrapper">
      <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading">Locate Device<span class="tools pull-right"> <a href="javascript:;" class="fa fa-chevron-down"></a></span> </header>
            <div class="panel-body">
                <!-- map here -->
            <div class="container">
               <div class="row">
                   <div  style="position: relative;">
                                <div class="map-overlay" onclick="style.pointerEvents='none'" style="pointer-events: none;"></div>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3320.601418000041!2d73.05560271553527!3d33.66748818071239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df956f4f307af5%3A0xd6e806e5b39a5bd6!2swe.R.play!5e0!3m2!1sen!2s!4v1455178212838" allowfullscreen="" style="width:100%; height:350px; border:none;"></iframe>
                   </div>
                </div>
             </div>

             <a href="#" onclick="" class="btn btn-info" style=" background-color:#DE5B5B;width: 50%;margin-left: 25%;margin-right: 25%;"><i class="fa fa-volume-up"></i><span> Alarm</span></a>
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
