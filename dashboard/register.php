<?php
	session_start();
	if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0)
	{
		
		echo '<script type="text/javascript">'
		   . 'window.location.href = "dashboard.php?flag=2"'
		   . '</script>';
	}//end of if
	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registration - House of QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <link href="assets/plugins/icheck/skins/all.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <style>
div.g-recaptcha {
  margin: 0 auto;
  width: 304px;
}
</style>
</head>

<body class="account separate-inputs" data-page="signup">
    <!-- BEGIN LOGIN BOX -->
    <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3">
                <div class="account-wall m-t-30">
                    <h2 class="m-t-0 m-b-15 c-white"><i class="fa fa-user"></i> Client <strong>Registration</strong></h2>
                    <form class="form-signup" action="process/registeration.php" role="form" method="post">
                        <div class="append-icon">
                            <input type="text" name="name" id="name" class="form-control form-white firstname" placeholder="Full Name" required autofocus>
                            <i class="icon-user"></i>
                        </div>
                        <div class="append-icon">
                            <input type="email" name="email" id="email" class="form-control form-white email" placeholder="Email" required>
                            <i class="icon-envelope"></i>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="append-icon">
                                    <input type="text" name="company" id="company" class="form-control form-white lastname" placeholder="Company Name" required>
                                    <i class="fa fa-building"></i>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="append-icon">
                                    <div class="append-icon">
                                        <input type="text" name="number" id="number" data-mask="(999) 999-9999 x9999" class="form-control form-white " placeholder="Contact No." required>
                                        <i class="icon-screen-smartphone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="append-icon">
                            <textarea name="address" rows="5" class="form-control  form-white" placeholder="Write your address... " minlength="20" required></textarea>
                        </div>
                        <br />
                        <div class="append-icon">
                            <input type="password" name="password" id="password" class="form-control form-white password" placeholder="Password" required>
                            <i class="icon-lock"></i>
                        </div>
                        <div class="append-icon m-b-10">
                            <input type="password" name="password2" id="password2" class="form-control form-white password2" placeholder="Repeat Password" required>
                            <i class="icon-lock"></i>
                        </div>
                        <div class="terms option-group">
                            <label for="terms" class="m-t-3">
                                <input type="checkbox" name="terms" id="terms" data-checkbox="icheckbox_square-blue" required/> I agree with terms and conditions
                            </label>
                        </div>
                        <div class="g-recaptcha"  align="center" data-sitekey="6Le4nggTAAAAAIBEURGcXQKoYX2Q-E57-iP7UB3-"></div>
                        <button type="submit" id="submit-form" class="btn btn-lg btn-dark m-t-20" data-style="expand-left">Register</button>
                        <div class="clearfix">
                            <p class="pull-right m-t-20"><a href="user-login-v1.html">Already have an account? Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <p class="account-copyright">
            <span>Copyright © 2015 </span><span>House of QA</span>. <span>All rights reserved.</span>
        </p>
    </div>
    <!-- END LOCKSCREEN BOX -->
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/icheck/icheck.min.js"></script>
    <script src="assets/plugins/backstretch/backstretch.min.js"></script>
    <script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/pages/login-v1.js"></script>
    <script src="assets/plugins/bootstrap/js/jasny-bootstrap.min.js"></script>
    <!-- File Upload and Input Masks -->
    <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
    
<?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 2)
				{
                    $type = "alert-warning";
                    $message = "<p><strong>Warning!</strong><br/>Wrong captcha image.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of inner if
				elseif($_GET['flag'] == 1)
				{
                    $type = "alert-danger";
                    $message = "<p><strong>Duplicate Name!</strong><br/>Email is already in use.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of if
				elseif($_GET['flag'] == 3)
				{
                    $type = "alert-success";
                    $message = "<p><strong>Registration Complete!</strong><br/>An activation E-mail have been sent to your account, please verify it.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of elseif
                elseif($_GET['flag'] == 4)
				{
                    $type = "alert-danger";
                    $message = "<p><strong>Re-Check Passwords!</strong><br/>Passwords do not match.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of if
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
    timeout: false,
});
</script>
<?php
            }
?>
</body>

</html>