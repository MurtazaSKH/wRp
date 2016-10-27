<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	$ativechk = 3;
	
	$deviceid = $_GET['did'];
	
	include("mysqlConnect.php");
	
	$query = "SELECT DeviceName, OSType, OSVersion, DIDs, EMEI, Resolution, Vendor, Priority from devicelist WHERE DeviceID = '$deviceid'";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row2 = mysql_fetch_array($result);
	
	if ($row2[4] == "")
	$row2[4] = "None";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">
<link rel="shortcut icon" href="#" type="image/png">
<title>Edit details for <?php echo $row2[0]; ?></title>

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
  <h3> Edit <?php echo $row2[0]; ?> </h3>
  <ul class="breadcrumb">
    <li> <a href="homepage.php">Dashboard</a> </li>
    <li> <a href="device_rc.php">Device Record</a> </li>
    <li class="active"> Edit <?php echo $row2[0]; ?> </li>
  </ul>
</div>

<!-- page heading end--> 

<!--body wrapper start-->
<div class="wrapper">
  <?php
			if(isset($_GET['flag']))
			{
			
				if($_GET['flag'] == 3)//Admin: Cleared all ownerships
				{
					echo "<div class=\"alert alert-danger fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "Fields cannot be empty";
                    echo "</div>";
				}//end of elseif
				elseif($_GET['flag'] == 4)//Admin: A single device cleared
				{
					echo "<div class=\"alert alert-danger fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "This record already exists in the database";
                    echo "</div>";
				}
			}//end of outer if
		?>
  <div class="row">
    <div class="col-lg-6">
      <section class="panel">
        <header class="panel-heading"> Edit following <?php echo $row2[1]; ?> Device </header>
        <div class="panel-body">
          <form role="form" action='processEditDevice.php' method='post'>
            <div class="form-group">
              <label for="osVersion" class="col-lg-2 col-sm-2 control-label">Device Name:</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="deviceName" name="deviceName" placeholder="Enter new device name">
                <p class="help-block">Current Device Name is <span class="label label-success"><?php echo $row2[0]; ?></span>.</p>
              </div>
            </div>
            <div class="form-group">
              <label for="osVersion" class="col-lg-2 col-sm-2 control-label">OS Version:</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="osVersion" name="osVersion" placeholder="Enter new OS Version">
                <p class="help-block">Enter OS version of the device current version is <span class="label label-default"><?php echo $row2[2]; ?></span>.</p>
              </div>
            </div>
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $deviceid; ?>">
           
            <div class="form-group">
              <label for="dids" class="col-lg-2 col-sm-2 control-label">UDID/AID</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="dids" name="dids" placeholder="Enter new UDID/AID">
                <p class="help-block">Find PGID or UDID/AID from the device and enter it. Current ID is <span class="label label-primary"><?php echo $row2[3]; ?></span>.</p>
              </div>
            </div>
         	
            <div class="form-group">
              <label for="imei" class="col-lg-2 col-sm-2 control-label">IMEI</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="imei" name="imei" placeholder="Enter new IMEI">
                <p class="help-block">Enter IMEI number of the device and current is <span class="label label-warning"><?php echo $row2[4]; ?></span>.</p>
              </div>
            </div>
         <div class="form-group">
              <label for="imei" class="col-lg-2 col-sm-2 control-label">Resolution</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="resolution" name="resolution" placeholder="Enter Resolution">
                <p class="help-block">Enter resolution as 1920 x 380 and current is <span class="label label-warning"><?php echo $row2[5]; ?></span></p>
              </div>
            </div>
         
          <div class="form-group">
              <label for="imei" class="col-lg-2 col-sm-2 control-label">Vendor</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="vendor" name="vendor" placeholder="Enter Vendor">
                <p class="help-block">Enter Vendors as Samsung, Apple, etc and current is <span class="label label-warning"><?php echo $row2[6]; ?></span></p>
              </div>
            </div>
         
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <div class="checkbox">
                  <label>
                  <input type="radio"  name="osType" value="Android">
                  <i class="fa fa-android"></i> Android 
                  </label>
                  
                  <label>
                  <input type="radio"  name="osType" value="iOS">
                  <i class="fa fa-apple"></i> iOS 
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <div class="checkbox">
                  <label>
                  <input type="radio"  name="pType" value="High">
                   High
                  </label>
                  
                  <label>
                  <input type="radio"  name="pType" value="Medium">
                   Medium 
                  </label>
                  
                  <label>
                  <input type="radio"  name="pType" value="Low">
                   Low 
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">Submit Details</button>
              </div>
            </div>
          </form>
        </div>
      </section>
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

<!--common scripts for all pages--> 
<script src="js/scripts.js"></script>
</body>
</html>