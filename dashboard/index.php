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
        <title>Login - House of QA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/ui.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    </head>
    <body class="account" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                      <h2 class="m-t-0 m-b-15 c-white"><i class="fa fa-user"></i> Client <strong>Login</strong></h2>
                        <form class="form-signin" action="process/login.php" role="form" method="post">
                            <div class="append-icon">
                                <input type="text" name="email" id="email" class="form-control form-white username" placeholder="E-mail" required>
                                <i class="icon-user"></i>
                            </div>
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Sign In</button>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a id="password" href="#">Forgot password?</a></p>
                                <p class="pull-right m-t-20"><a href="user-signup-v1.html">New here? Sign up</a></p>
                            </div>
                        </form>
                        <form class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="text" name="email" class="form-control form-white email" placeholder="E-Mail" required>
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password Reset Link</button>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a id="login" href="#">Already got an account? Sign In</a></p>
                                <p class="pull-right m-t-20"><a href="user-signup-v1.html">New here? Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="account-copyright">
                <span>Copyright © 2015 </span><span>House of QA</span>. <span>All rights reserved.</span>
            </p>
        </div>
        <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/plugins/gsap/main-gsap.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="assets/js/pages/login-v1.js"></script>
            <!-- File Upload and Input Masks -->
    	<script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
    
<?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 2)
				{
                    $type = "alert-danger";
                    $message = "<p><strong>Wrong E-Mail!</strong><br/>Account with this E-Mail address doesn't exist.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of inner if
				elseif($_GET['flag'] == 1)
				{
                    $type = "alert-danger";
                    $message = "<p><strong>Wrong Password!</strong><br/>Either password field is empty or password is wrong.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of if
				elseif($_GET['flag'] == 3)
				{
                    $type = "alert-warning";
                    $message = "<p><strong>Activate Account!</strong><br/>Please check you E-Mail for activation of your account.</p>";
                    $position = "topRight";
                    $timeout = "6000";
                    
				}//end of elseif
				elseif($_GET['flag'] == 4)
				{
                    $type = "alert-warning";
                    $message = "<p><strong>Session Timeout!</strong><br/>Session timesout please login again.</p>";
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
    timeout: false,
});
</script>
<?php
            }
?>
    </body>
</html>