<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	
	
			
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)
				{
					echo "<div class=\"alert alert-block alert-danger fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Invalid email or password.</strong> <a href='passwordRetrieval.php'>Click here</a> if you forgot your password.";
                    echo "</div>";	
				}//end of inner if
				if($_GET['flag'] == 2)
				{
					session_destroy();
					echo "<div class=\"alert alert-info fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
					echo "<strong>Session Expired.</strong> Please Login again";
					echo "</div>";
				}//end of if
				if($_GET['flag'] == 'kill')
				{
					session_destroy();
				}
				if ($_GET['flag'] == 3)
				{	
					$to = $_GET['email'];
					$toEID = $_GET['eid'];
					echo "<div class=\"alert alert-warning fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
					echo "<strong>Account not activated.</strong> <a href='sendRegisterationEmail.php?eid=\".$toEID.\"&to=\".$to.\"'>Click here </a>to send the link again";
					echo "</div>";
					
				}//end of if
				if ($_GET['flag'] == 4)
				{
					echo "<div class=\"alert alert-block alert-danger fade in\">";
                    echo "<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\">";
                    echo "<i class=\"fa fa-times\"></i>";
                    echo "</button>";
                    echo "<strong>Email not registered</strong> Please Register for an account.";
                    echo "</div>";
					
				}//end of if
			}//end of if
			
	if(isset($_SESSION['ID']) && $_SESSION['ID'] != 0)
	{
		
		echo '<script type="text/javascript">'
		   . 'window.location.href = "homepage.php?newid='. $_SESSION['ID'].'"'
		   . '</script>';
	}//end of if
		?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Login</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
 
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" name="loginForm" action="processLogin.php" method="post">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Sign In</h1>
            <img src="images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" name="email1" id="email1" class="form-control" placeholder="E-Mail" autofocus value="">
             
            <input type="hidden" name="arg" id="arg" value="">
            <input type="password" name="password" class="form-control" placeholder="Password">

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

            <div class="registration">
                Not a member yet?
                <a class="" href="registerationForm.php">
                    Signup
                </a>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    

                </span>
            </label>

        </div>

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

</body>
</html>
