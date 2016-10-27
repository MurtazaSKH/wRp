<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Account Settings - House of QA"; ?>
<head>
<?php include("requiredfiles/head.php"); ?>

<!-- BEGIN PAGE STYLE -->
<link href="assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
<link href="assets/plugins/charts-morris/morris.min.css" rel="stylesheet">
</head>
<?php
	
	include("requiredfiles/mysqlConnect.php");

	//get the EID and password
	$query = "SELECT * FROM client WHERE id = '$userID'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
	$row['id'];
	
	mysql_close($db);
?>
<?php include("requiredfiles/style.php"); ?>
<section>
<!-- BEGIN SIDEBAR -->
<?php include("requiredfiles/sidebar.php"); ?>
<!-- END SIDEBAR -->
<div class="main-content">
<!-- BEGIN TOPBAR -->
<?php include("requiredfiles/topbar.php"); ?>
<!-- END TOPBAR --> 
<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
  <div class="header">
    <h2><strong>Account</strong> Settings</h2>
    <div class="breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a> </li>
        <li><a href="#">Account</a> </li>
        <li class="active">Account Settings</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <form role="form" class="form-validation" method="POST" action="process/updateprofile.php" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
              <h2 class="panel-title">Update <strong>account</strong> settings</h2>
            </div>
            <div class="panel-body bg-white">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Full Name</label>
                        <div class="append-icon">
                          <input type="text" name="name" class="form-control" minlength="3" value="<?php echo $row['name']; ?>" placeholder="Minimum 3 characters..." required>
                          <input type="hidden" name="email" id="email" value="<?php echo $row['email']; ?>" >
                          <i class="icon-user"></i> </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Company</label>
                        <div class="append-icon">
                          <input type="text" name="company" class="form-control" minlength="4" value="<?php echo $row['company']; ?>" placeholder="Minimum 4 characters..." required>
                          <i class="icon-user"></i> </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Upload company logo</label>
                        <div class="append-icon"> <img class="img-lg img-circle" src="<?php echo "/dashboard".$row['img_loc']; ?>" alt="Image"> </div>
                        <br />
                        <div class="file">
                          <div class="option-group"> <span class="file-button btn-primary">Choose File</span>
                            <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                            <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Phone Number</label>
                        <div class="append-icon">
                          <input type="text" name="number" id="number" data-mask="(999) 999-9999 x9999" class="form-control" value="<?php echo $row['contactno']; ?>" placeholder="Contact No." required>
                          <i class="icon-screen-smartphone"></i> </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <div class="append-icon">
                          <textarea name="address" rows="5" class="form-control" placeholder="Write your address... " minlength="20" required><?php echo $row['address']; ?></textarea>
                          <i class="icon-envelope"></i> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="panel">
            <div class="panel-header header-line">
              <h3>Change <strong>Password</strong></h3>
            </div>
            <div class="panel-body">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">New Password</label>
                  <div class="append-icon">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16">
                    <i class="icon-lock"></i> </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Repeat Password</label>
                  <div class="append-icon">
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16">
                    <i class="icon-lock"></i> </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Old Password</label>
                  <div class="append-icon">
                    <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16">
                    <i class="icon-lock"></i> </div>
                </div>
              </div>
            </div>
            <div class="panel-footer clearfix">
              <div class="pull-right">
                <button type="reset" class="btn btn-white m-r-10">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php include("requiredfiles/footer.php"); ?>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<!-- END MAIN CONTENT -->
</section>
<!-- BEGIN QUICKVIEW SIDEBAR -->
<?php include("requiredfiles/quickview.php"); ?>
<!-- END QUICKVIEW SIDEBAR --> 
<!-- BEGIN PRELOADER -->
<?php include("requiredfiles/preloader.php"); ?>
<!-- END PRELOADER -->
<?php include("requiredfiles/javascript.php"); ?>
<script src="assets/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch --> 
<script src="assets/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs --> 
<script src="assets/plugins/dropzone/dropzone.min.js"></script> <!-- Upload Image & File in dropzone --> 
<script src="assets/js/pages/form_icheck.js"></script> <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL --> 
<script src="assets/plugins/bootstrap-slider/bootstrap-slider.js"></script> <!-- Bootstrap Input Slider --> 
<script src="assets/plugins/ion-slider/ion.rangeSlider.min.js"></script> <!-- Range Input Slider --> 
<script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
<?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)//Required fields are still empty
				{
                    $type = "alert-warning";
                    $message = "<p><strong>Warning!</strong> Required fields are still empty.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of inner if
				elseif($_GET['flag'] == 2)// Duplicate Name
				{
                    $type = "alert-danger";
                    $message = "<p><strong>Duplicate Name!</strong> A package with same name have been already created.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of if
				elseif($_GET['flag'] == 3)//Package was created successfully.
				{
                    $type = "alert-success";
                    $message = "<p><strong>Success!</strong> Package was created successfully.  <a href=\"packages.php\">View Packages</a></p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of elseif
?>
<script>
    var n = noty({
    text        : '<div class="alert <?php echo $type; ?>"><?php echo $message; ?></div>',
    layout      : '<?php echo $position; ?>', //or left, right, bottom-right...
    theme       : 'made',
    maxVisible  : 10,
    animation   : {
        open  : 'animated bounceInRight',
        close : 'animated fadeOut'
    },
    timeout: <?php echo $timeout; ?>,
});
</script>
<?php
            }
?>
</body>
</html>