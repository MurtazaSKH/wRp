<!DOCTYPE html>
<html>
    <head>
        <!-- BEGIN META SECTION -->
        <meta charset="utf-8">
        <title> Portal | SignUp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
        <!-- END META SECTION -->
        <!-- BEGIN MANDATORY STYLE -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/ui.css" rel="stylesheet">
        <link href="assets/plugins/step-form-wizard/css/step-form-wizard.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
        <script src="./includes/ajax.js"></script>
        <!-- END  MANDATORY STYLE -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script>
        //window.onload = checkSession;
      </script>
        
    </head>
    <body class="account" data-page="lockscreen">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" >
            <div class="page-content" style="margin:6% 22%; min-width:100%;">
          <div class="row" style="margin-top:auto;">
            <div class="col-md-6">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark" >
                  <h2 class="panel-title" style="padding: 6px 15px 6px 18px; font-size:25px;" ><strong>Sign Up</strong> and start managing your devices.</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" action="javascript:existingMail();" class="form-validation">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Full name</label>
                              <div class="append-icon">
                                <input type="text" name="fullname" id="fullname" class="form-control" minlength="3" placeholder="Minimum 3 characters." required="" aria-required="true">
                                <div id="fullname-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Employee ID</label>
                              <div class="append-icon">
                                <input type="number" name="employee" id="employee" class="form-control" minlength="1" placeholder="Minimum 1 digit." required="" aria-required="true">
                                <div id="employee-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Company Email</label>
                              <div class="append-icon">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your company email." required="" aria-required="true">
                                <div id="email-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"> Personal Email</label>
                              <div class="append-icon">
                                <input type="email" name="persoemail" id="persoemail" class="form-control" placeholder="Enter your personal email." required="" aria-required="true">
                                <div id="persoemail-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Birthdate</label>
                              <div class="append-icon">
                                <input type="date" name="birthdate" id="birthdate" class="form-control" style="height:35px;" placeholder="Select birthdate" minlength="3" required="" aria-required="true">
                                <div id="birthdate-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-screen-smartphone"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Designation</label>
                              <div class="append-icon">
                                <input type="text" name="desig" id="desig" class="form-control" placeholder="Enter your Designation." required="" aria-required="true">
                                <div id="desig-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Team</label>
                              <div class="append-icon">
                                <input type="text" name="team" id="team" class="form-control" placeholder="Enter your Designation." required="" aria-required="true">
                                <div id="desig-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>

                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Company</label>
                              <div class="append-icon">
                                <input type="text" name="company" id="company" class="form-control" placeholder="Enter company name." required="" aria-required="true">
                                <div id="company-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div> -->

                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Upload your avatar</label>
                              <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;" required="" aria-required="">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                            </div>
                          </div> -->

                          <!-- this input will tell us this is new registration or create user -->
                          <div style="display:none;">
                            <input type="text" name="todo" id="todo" value="addnewuser" class="form-control" style="height:35px;" placeholder="Select birthdate" minlength="3" required="" aria-required="true">
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Password</label>
                              <div class="append-icon">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16" required="" aria-required="true">
                                <div id="password-error" class="form-error" style="display:none;">Required</div>
                                <i class="icon-lock"></i>
                              </div>
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
                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"></label>
                              <div class="option-group">
                                <label for="terms" class="m-t-10">
                                <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" name="terms" id="terms" data-checkbox="icheckbox_square-blue" required="" aria-required="true" onclick="chcc()" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);" ></ins></div>
                                I agree with terms and conditions
                                </label>    
                              </div>
                            </div>
                          </div> -->
                        </div>
                        <div>
                           <div class="g-recaptcha" data-sitekey="6LfOFwgTAAAAAPsOyoUfGRzBZhy4FL0RLt08rg41" style="margin:0px 12%;"></div>
                                    
                        </div>
                        
                        <div class="text-center  m-t-20">
                          <!-- <button  class="btn btn-embossed btn-primary">Sign Up</button> -->
                          <!-- <s href="#" onclick="signup()" class="btn btn-embossed btn-primary">Sign Up</a> -->
                          <button type="submit" id="adduserbutton"  class="btn btn-embossed btn-primary">Sign Up</button>
                          <a href="index.php" type="reset" style="color:gray;" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</a>
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
        <div class="loader-overlay loaded">
            <div class="loader-inner">
                <div class="loader2"></div>
            </div>
        </div>
        <div class="footer" style="position:fixed; bottom:10px;">
            <div class="copyright">
              <p class="pull-left sm-pull-reset" style="position:fixed; bottom:10px; left:10px; color:white;">
                <span>Copyright <span class="copyright">©</span> 2016  </span>
                &nbsp&nbsp|<a href="http://www.werplay.com/" class="m-l-10 m-r-10"><span>we.R.play</span></a>
              </p>
              <p class="pull-right sm-pull-reset" style="position:fixed; bottom:10px; right:10px;">
                <span><a href="index.php" class="m-r-10">Log in</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a>
              </p>
            </div>
          </div>
        <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        
        <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script> 
        <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
        <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/plugins/gsap/main-gsap.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="assets/plugins/progressbar/progressbar.min.js"></script>
        
        <script src="assets/plugins/step-form-wizard/plugins/parsley/parsley.min.js"></script> <!-- OPTIONAL, IF YOU NEED VALIDATION -->
        <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
        <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script type="text/javascript">
            // $(document).keypress(function(event) {
            //     var keycode = (event.keyCode ? event.keyCode : event.which);
            //     if(keycode == '13') {
            //         alert('You pressed a "enter" key in somewhere');    
            //     }
            // });
        </script>
        <script src="assets/plugins/step-form-wizard/js/step-form-wizard.js"></script> <!-- Step Form Validation -->
        <script src="assets/js/pages/form_wizard.js"></script>
        <script src="assets/plugins/icheck/icheck.min.js"></script>
        <!-- checking if yes on terms and conditions -->
        <script>
          function chcc(){
              alert("checking");
              // if(this.checked){
              //      //asd   
              //     }
          };
        </script>

        
    </body>
</html>
