<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | Edit Profile </title>
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
            if(!isset($_SESSION['email']))
            {
              header('Location: index.php');
            }
            else
            {
              $query=("SELECT * FROM employee where Email='".$_SESSION['email']."'");
              $result = mysqli_query($db,$query);

              if(mysqli_num_rows($result) > 0)
              {
                $row = mysqli_fetch_assoc($result);
              }
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
          <div class="col-lg-10 col-md-9">
              <div class="row profil-header">
              <div class="col-lg-9 col-md-12">
                <div class="row">
                  <div class="col-xs-4 profil-img">
                    <img <?php echo "src='./assets/avatars/".$_SESSION['avatar']."'" ?>>
                  </div>

                  <div class="col-xs-6 header-name">
                    <div class="name"><?php echo $row['Name']; ?></div>
                    <div class="profil-info"><i class="icon-present"></i><?php echo $row['DateofBirth'];?>
                      </div>
                    
                    <div class="profil-info"><i class="icon-call-end"></i>
                        <?php
                          $query3=("SELECT * FROM company where CompanyID='".$row['company']."'");
                          $result3 = mysqli_query($db,$query3);

                          if(mysqli_num_rows($result3) > 0)
                          {
                            $row3 = mysqli_fetch_assoc($result3);
                          }
                          echo $row3['CompanyName'];
                        ?>
                    </div>
                    <div class="profil-info"><i class="icon-call-end"></i>
                        <?php echo $row['Designation'];?>
                    </div>
                    <form method="post" id="formavatar" onsubmit="return submitimage();">
                    <div class="col-sm-6" style="margin-top:10px;">
                            <div class="form-group">
                              <div class="file">
                                <div class="option-group">
                                  <!-- <span class="file-button btn-primary" style="width:10px;">Choose File</span> -->
                                  <input type="file" class="custom-file" name="file" id="file" onchange="document.getElementById('uploader').value = this.value; " required="" aria-required="">
                                  <input type="text" class="form-control" id="uploader" placeholder="Select Avatar" readonly="">
                                  <div id="avatarmsg" class="form-error" style="display:none; color:#319DB5;">Please wait while avatar is uploading...</div>
                                </div>
                              </div>
                            </div>
                      </div>
                      <div class="col-sm-6" style="margin-top:10px;">
                            <div class="form-group">
                              <button  class="btn btn-embossed btn-primary">Upload</button>
                            </div>

                      </div>                          
                    </form>
                  </div>
                  
                </div>
              </div>
              
            </div>
            </div>
          <div class="row">
            <!-- start profile header -->
            
            <div class="col-lg-12 ">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <!-- <h3><i class="fa fa-table"></i> <strong>Editable</strong> Tables</h3> -->
                </div>
                
                <div class="panel-content">
                  <div class="row" style="margin-top:auto;">
            <div class="col-md-12">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark" >
                  <h2 class="panel-title" style="padding: 6px 15px 6px 18px; font-size:25px;" ><strong>Edit Profile</strong> <!-- and start managing your devices. --></h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" method="post"  class="form-validation"  action="javascript:PinCheck_upateprofile();">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Full name</label>
                              <div class="append-icon">
                                <input type="text" name="fullname" id="fullname" class="form-control" minlength="3" placeholder="Minimum 3 characters." required="" <?php echo 'value="'.$row['Name'].'"'; ?> aria-required="true">
                                <div id="fullname-error" class="form-error" style="display:none;"  >Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Employee ID</label>
                              <div class="append-icon">
                                <input type="number" name="employee" id="employee" class="form-control" minlength="1" placeholder="Minimum 1 digit." <?php echo 'value="'.$row['EmployeeID'].'"'; ?> aria-required="true">
                                <div id="employee-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Company Email</label>
                              <div class="append-icon">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your company email." <?php echo 'value="'.$row['Email'].'"'; ?> required="" aria-required="true" readonly="true">
                                <div id="email-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label"> Personal Email</label>
                              <div class="append-icon">
                                <input type="email" name="persoemail" id="persoemail" class="form-control" placeholder="Enter your personal email."  <?php echo 'value="'.$row['PersonalEmail'].'"'; ?> aria-required="true">
                                <div id="persoemail-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Birthdate </label>
                              <?php 
                                // echo 'value="'.date_format($row['DateofBirth'],'Y-m-d').'"'; 
                              ?>
                              <div class="append-icon">
                                <input type="date" name="birthdate" id="birthdate" class="form-control" style="height:35px;" placeholder="Select birthdate" <?php echo 'value="'.$row['DateofBirth'].'"'; ?> minlength="3" required="" aria-required="true">
                                <div id="birthdate-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-screen-smartphone"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Designation</label>
                              <div class="append-icon">
                                <input type="text" name="desig" id="desig" class="form-control" placeholder="Enter your Designation." <?php echo 'value="'.$row['Designation'].'"'; ?> required="" aria-required="true" >
                                <div id="desig-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Team</label>
                              <div class="append-icon">
                                <input type="text" name="team" id="team" class="form-control" placeholder="Enter your Designation." <?php echo 'value="'.$row['Team'].'"'; ?> required="" aria-required="true">
                                <div id="desig-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Company</label>
                              <div class="append-icon">
                                <input type="text" name="company" id="company" class="form-control" placeholder="Enter company name." <?php
                              $query3=("SELECT * FROM company where CompanyID='".$row['company']."'");
                              $result3 = mysqli_query($db,$query3);

                              if(mysqli_num_rows($result3) > 0)
                              {
                                $row3 = mysqli_fetch_assoc($result3);
                              }
                                 echo 'value="'.$row3['CompanyName'].'"'; ?> required="" aria-required="true" readonly="true">
                                <div id="company-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <!-- <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Upload your avatar</label>
                              <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value; submitimage();" required="" aria-required="">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                  <div id="avatarmsg" class="form-error" style="display:none; color:#319DB5;">Please wait while avatar is uploading...</div>
                                </div>
                              </div>
                            </div>
                          </div> -->

                          <div class="col-sm-12">

                          </div>

                          <!-- this input will tell us this is new registration or create user or update profile -->
                          <div style="display:none;">
                            <input type="text" name="todo" id="todo" value="updateProfile" class="form-control" style="height:35px;" placeholder="Select birthdate" minlength="3" required="" aria-required="true">
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Change Password</label>
                              <div class="append-icon">
                                <input type="password"  name="password" id="password" class="form-control" placeholder="****************************" minlength="8" maxlength="16" >
                                <div id="password-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label" style="Background-color:yellow;">Change PIN </label><span style="color:grey;"> PIN must be 5 digits</span>
                              <div class="append-icon">
                                <input type="number"  name="pin" id="pin"  class="form-control" placeholder="****************************" minlength="5" maxlength="5" >
                                <div id="pin-error" class="form-error"  style="display:none;">Required</div>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6" style="display:none;">
                            <div class="form-group">
                              <label class="control-label">What's the result of 4 + 8 ?</label>
                              <input type="text" name="calcul" class="form-control" id="verify" placeholder="Human verification!" value="12">
                              <div id="verify-error" class="form-error" style="display:none;">Incorrect Input!</div>
                            </div>
                          </div>

                          

                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Repeat your password</label>
                              <div class="append-icon">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="Must be equal to your first password..." minlength="4" maxlength="16" required="" aria-required="true">
                                <div id="password2-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div> -->
                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"></label>
                            </div>
                          </div>
                        </div>
                        <div class="text-center  m-t-20">
                          <button  class="btn btn-embossed btn-primary">Update Profile</button>
                          <!-- <a onclick="updateProfile()" class="btn btn-embossed btn-primary">Update Profile</a> -->
                        </div>
                      </form>

                      <input type="password" id="passwordchanged" class="form-control" placeholder="Must be equal to your first password..." minlength="4" maxlength="16" style="display:none;" required="" aria-required="true">
                      <input type="text" id="pinchanged" value="0" class="form-control" placeholder="" minlength="4" maxlength="4" style="display:none;" required="" aria-required="true">
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

    <script type="text/javascript">
        function submitimage() {
            document.getElementById('avatarmsg').style.display='inline';

            var fd = new FormData(document.getElementById("formavatar"));
            fd.append("label", "WEBUPLOAD");
            jQuery.ajax({
              url: "upload.php",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
              document.getElementById('avatarmsg').innerHTML=data;
                //console.log("PHP Output:"+data);
                //alert("Ended with the following output: "+data)
            });
            return false;
        }

        // $("password").click(function(){
        //     $("#input").val("test");
        //     $("#input").trigger("change");
        // })

        $("#password").bind("change paste input", function(){
            if(document.getElementById("password").value=="")
            {
              document.getElementById("passwordchanged").value="0";
            }
            else
            {
              document.getElementById("passwordchanged").value="1";
            }


        });

        $("#pin").bind("change paste input", function(){
            if(document.getElementById("pin").value=="")
            {
              document.getElementById("pinchanged").value="0";
            }
            else
            {
              document.getElementById("pinchanged").value="1";
            }
        }); 
    </script>

    <!-- END PAGE SCRIPTS -->
  </body>
</html>