<!DOCTYPE html>
<html lang="en">

    <?php $pageTitle = "Create Project - House of QA"; ?>

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
            <h2><strong>Blank</strong> Page</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Make</a>
                </li>
                <li><a href="#">Pages</a>
                </li>
                <li class="active">Dashboard</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12" style="height:720px">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Sign Up</strong> to our website</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" class="form-validation">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Firstname</label>
                              <div class="append-icon">
                                <input type="text" name="firstname" class="form-control" minlength="3" placeholder="Minimum 3 characters..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Lastname</label>
                              <div class="append-icon">
                                <input type="text" name="lastname" class="form-control" minlength="4" placeholder="Minimum 4 characters..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Email Address</label>
                              <div class="append-icon">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email..." required>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Choose your language</label>
                              <div class="option-group">
                                <select id="language" name="language" class="language" required>
                                  <option value="">Select language...</option>
                                  <option value="EN">English</option>
                                  <option value="FR">French</option>
                                  <option value="SP">Spanish</option>
                                  <option value="CH">Chinese</option>
                                  <option value="JP">Japanese</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Phone Number</label>
                              <div class="append-icon">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile Number..." minlength="3" required>
                                <i class="icon-screen-smartphone"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Upload your avatar</label>
                              <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;" required>
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Password</label>
                              <div class="append-icon">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16" required>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Repeat your password</label>
                              <div class="append-icon">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="Must be equal to your first password..." minlength="4" maxlength="16" required>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">What's the result of 4 + 8 ?</label>
                              <input type="text" name="calcul" class="form-control" placeholder="Human verification!">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Are you OK with our terms?</label>
                              <div class="option-group">
                                <label  for="terms" class="m-t-10">
                                <input type="checkbox" name="terms" id="terms" data-checkbox="icheckbox_square-blue" required/>
                                I agree with terms and conditions
                                </label>    
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="text-center  m-t-20">
                          <button type="submit" class="btn btn-embossed btn-primary">Sign Up</button>
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
        <script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation -->
    <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script> <!-- Form Validation Additional Methods - OPTIONAL -->
  </body>
</html>