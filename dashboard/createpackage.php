<!DOCTYPE html>
<html lang="en">

    <?php $pageTitle = "Create Package - House of QA"; ?>

<head>
     <?php include("requiredfiles/head.php"); ?> 

    <!-- BEGIN PAGE STYLE -->
    <link href="assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="assets/plugins/charts-morris/morris.min.css" rel="stylesheet">
    
</head>
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
            <h2><strong>Create</strong> Package</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a>
                </li>
                <li><a href="#">Admin</a>
                </li>
                <li class="active">Create Package</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12" style="height:720px">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title">Create <strong>Packages</strong> to sell</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" class="form-validation" action="process/addpackage.php" method="POST">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Package Name</label>
                              <div class="append-icon">
                                <input type="text" name="name" class="form-control" minlength="3" placeholder="Minimum 3 characters..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <p><strong>Platforms</strong>
                              </p>
                              <div class="input-group">
                                <div class="icheck-inline">
                                  <label>
                                  <input type="checkbox" name="platform[]" value="android" checked data-checkbox="icheckbox_square-blue"> Android</label>
                                  <label>
                                  <input type="checkbox" name="platform[]" value="ios" checked data-checkbox="icheckbox_square-blue"> iOS</label>
                                  <label>
                                  <input type="checkbox" name="platform[]" value="web" data-checkbox="icheckbox_square-blue"> Web</label>
                                </div>
                              </div>
                            </div>
                          </div>
                            <div class="col-md-6">
                        <div class="form-group">
                          <label>Select types of Testing allowed</label>
                          <select multiple class="form-control" name="testing[]" data-placeholder="Choose one or various testing..." required>
                              <option value="functional">Functional</option>
                              <option value="compliance">Compliance</option>
                              <option value="compatibility">Compatibility</option>
                              <option value="soak">Soak & Sanity</option>
                              <option value="localization">Localization</option>
                              <option value="regression">Regression</option>
                              <option value="performance">Performance/Load</option>
                              <option value="multiplayer">Multiplayer</option>
                              <option value="iap">iAP & Social</option>
                              <option value="upgrade">Upgrade</option>
                          </select>
                        </div>
                      </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Devices (per platform)</label>
                              <div class="append-icon">
                                <input class="form-control input-sm" name="devices" type="number" placeholder="Type a number" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Number of Hours</label>
                              <div class="append-icon">
                                <input class="form-control input-sm" name="hours" type="number" placeholder="Type a number" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Number of Testplans</label>
                              <div class="append-icon">
                                <input class="form-control input-sm" name="testplans" type="number" placeholder="Type a number" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <p><strong>Communication</strong>
                              </p>
                              <div class="input-group">
                                <div class="icheck-inline">
                                  <label>
                                  <input type="checkbox" name="commu[]" value="gchat" checked data-checkbox="icheckbox_square-blue"> GChat / Email</label>
                                  <label>
                                  <input type="checkbox" name="commu[]" value="slack" checked data-checkbox="icheckbox_square-blue"> Slack</label>
                                  <label>
                                  <input type="checkbox" name="commu[]" value="hipchat" data-checkbox="icheckbox_square-blue"> Hipchat</label>
                                </div>
                              </div>
                            </div>
                          </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                              <p><strong>Reporting Tools</strong>
                              </p>
                              <div class="input-group">
                                <div class="icheck-inline">
                                  <label>
                                  <input type="checkbox" name="reporting[]" value="excel" checked data-checkbox="icheckbox_square-blue"> Excel Spreadsheet</label>
                                  <label>
                                  <input type="checkbox" name="reporting[]" value="trello" checked data-checkbox="icheckbox_square-blue"> Trello</label>
                                  <label>
                                  <input type="checkbox" name="reporting[]" value="jira" data-checkbox="icheckbox_square-blue"> Jira</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <p><strong>Extras</strong>
                              </p>
                              <div class="input-group">
                                <div class="icheck-inline">
                                  <label>
                                  <input type="checkbox" name="lead" value="1" checked data-checkbox="icheckbox_square-blue"> Add Lead</label>
                                  <label>
                                  <input type="checkbox" name="extradevices" value="1" checked data-checkbox="icheckbox_square-blue"> Extra Devices</label>
                                  <label>
                                  <input type="checkbox" name="extraverify" value="1" checked data-checkbox="icheckbox_square-blue"> Extra Verifications</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Number of Verifications</label>
                              <div class="append-icon">
                                <input class="form-control input-sm" type="number" name="verifications" placeholder="Type a number" required>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Amount</label>
                              <div class="append-icon">
                                <input type="text" name="amount" class="form-control" placeholder="Enter amount in $" required>
                                <i class="icon-usd"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Is this a Monthly package?</label>
                              <div class="option-group">
                                <label  for="terms" class="m-t-10">
                                <input type="checkbox" name="monthyl" value="1" id="monthly" data-checkbox="icheckbox_square-blue"/>
                                Yes it is!
                                </label>    
                              </div>
                            </div>
                          </div>                            
                        <div class="text-center  m-t-20">
                          <button type="submit" class="btn btn-embossed btn-primary">Create</button>
                          <button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    <script src="assets/plugins/dropzone/dropzone.min.js"></script>  <!-- Upload Image & File in dropzone -->
    <script src="assets/js/pages/form_icheck.js"></script>  <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL -->
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