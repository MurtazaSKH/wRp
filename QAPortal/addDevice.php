<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | Admin - Add Device</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    
    <!--  -->
    <script src="./includes/ajax.js"></script>
    <script>
        window.onload = checkSession;
      </script>

    <!-- Including Connection File -->
        <?php include ('./includes/mysqlConnect.php'); ?>
        <!-- check if logged in -->
        <?php 
            session_start();
            if(!isset($_SESSION['editdeviceGo']))
            {
              header('Location: index.php');
            }
            else
            {
              // $query=("SELECT * FROM devicelist where DeviceID='".$_SESSION['editdeviceGo']."'");
              // $result = mysqli_query($db,$query);

              // if(mysqli_num_rows($result) > 0)
              // {
              //   $row = mysqli_fetch_assoc($result);
              // }
            }
         ?>
  </head>
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <?php include ('./includes/sidebar.php'); ?>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <?php include ('./includes/topbar.php'); ?>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-app page-profil">
          <!-- <div class="header">
            <h2>Add <strong>User</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a>
                </li>
                <li><a href="viewdevices.php">Devices</a>
                </li>
                <li class="active">Checkout</li>
              </ol>
            </div>
          </div> -->
          
          <div class="row">
            <!-- start profile header -->
            
            <div class="col-lg-12 ">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <!-- <h3><i class="fa fa-table"></i> <strong>Editable</strong> Tables</h3> -->
                </div>
                
                <div class="panel-content">
                  <div class="row" style="margin-top:auto;">
            <div class="col-md-6">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark" >
                  <h2 class="panel-title" style="padding: 6px 15px 6px 18px; font-size:25px;" ><strong>Add Device</strong></h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" method="post"  class="form-validation" action="javascript:addDevice();" id="formavatar" name="formavatar" >
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Device name</label>
                              <div class="append-icon">
                                <input type="text" name="devicename" id="devicename" class="form-control" minlength="3" placeholder="" required="" aria-required="true">
                                <div id="devicename-error" class="form-error" style="display:none;"  >Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">OS Type</label>
                              <div class="append-icon">
                                <input type="text" name="deviceos" id="deviceos" class="form-control" minlength="1"  required=""  aria-required="true">
                                <div id="deviceos-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">OS Version</label>
                              <div class="append-icon">
                                <input type="text" name="osversion" id="osversion" class="form-control"   required="" aria-required="true" >
                                <div id="osversion-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label"> Resolution</label>
                              <div class="append-icon">
                                <input type="text" name="resolution" id="resolution" class="form-control"  required=""  aria-required="true">
                                <div id="persoemail-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Vendor </label>
                              <?php 
                                // echo 'value="'.date_format($row['DateofBirth'],'Y-m-d').'"'; 
                              ?>
                              <div class="append-icon">
                                <input type="text" name="vendor" id="vendor" class="form-control" style="height:35px;"  minlength="3" required="" aria-required="true" >
                                <div id="vendor-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-screen-smartphone"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Priority</label>
                              <div class="append-icon">
                                <input type="text" name="priority" id="priority" class="form-control" required="" aria-required="true" >
                                <div id="priority-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">IMEI</label>
                              <div class="append-icon">
                                <input type="text" name="imei" id="imei" class="form-control"   >
                                <div id="imei-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">UDID/DID</label>
                              <div class="append-icon">
                                <input type="text" name="udid" id="udid" class="form-control" >
                                <div id="udid-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          

                          <div class="col-sm-12">

                          </div>

                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"></label>
                            </div>
                          </div>
                        </div>
                        <div class="text-center  m-t-20">
                          <button  class="btn btn-embossed btn-primary">Add Device</button>
                          <!-- <a href="#" onclick="addDevice()" class="btn btn-embossed btn-primary">Add Device</a> -->
                          <!-- <a href="index.php" type="reset" style="color:gray;" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</a> -->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                </div>
              </div>
            </div>
          </div>
          <?php include ('./includes/footer.php'); ?>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="assets/plugins/charts-chartjs/Chart.min.js"></script>
    
    <script src="assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <!-- BEGIN PAGE SCRIPTS -->
    <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <!-- 
    editable tables
    <script src="assets/js/pages/table_editable.js"></script>
     -->
    
    <script src="assets/js/pages/table_dynamic.js"></script>

    <script src="assets/plugins/gsap/main-gsap.min.js"></script> <!-- HTML Animations -->
    <script src="assets/plugins/slick/slick.min.js"></script> <!-- Slider -->
    <script src="assets/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
    <script src="assets/plugins/autosize/autosize.min.js"></script> <!-- Textarea autoresize -->
    
    <script src="assets/js/pages/profil.js"></script> 

    <!-- END PAGE SCRIPTS -->
  </body>
</html>